<?php /* Template Name: Calendar page */ ?>
<?php get_header(); ?>

<?php 
$args = $args = array(
    'post_type' => 'seminar',
    'posts_per_page' => 99999999,
);
if (!empty($_GET['theme'])) {
    $args['tax_query'][] = array(
        array(
            'taxonomy' => 'seminar_theme',
            'field'    => 'slug',
            'terms'    => array($_GET['theme']),
            'operator' => 'IN',
        ),
    );
}
$query = new WP_Query($args);
$seminars = [];
foreach ($query->posts as $post) {
   
    if (has_term('exklusiv','seminar_type',$post->ID)) {
        $color = 'yellow';
    } else {
        if (get_field('main_options',$post->ID)['shortly']) {
            $color = 'green';
        } else {
            $color = 'gray';
        }
    }

    $seminars[] = [
        'url' => get_the_permalink($post->ID),
        'dates' => get_field('main_options',$post->ID)['dates'],
        'title' => get_the_title($post->ID),
        'plave' => get_field('main_options',$post->ID)['venue'],
        'color' => $color,
    ];
}
?>


<style>
    .fc .fc-daygrid-day-top{
        margin-bottom: -1.8rem;
    }
    .fc-daygrid-day-frame::before{
        content: none!important;
    }
    .fc .fc-scroller-liquid-absolute::-webkit-scrollbar {
        background-color: transparent;
        width: 0.2rem;
    }

    .fc .fc-scroller-liquid-absolute::-webkit-scrollbar-thumb {
        background-color: var(--color-black);
        border-radius: 2rem;
    }
    .calendar table{
        border:none;
    }
     .fc-theme-standard th, .fc-theme-standard .fc-scrollgrid{
     border:none;
    }
    .fc .fc-scrollgrid-section-footer > *, .fc .fc-scrollgrid-section-header > *{
        border-bottom: 0.1rem solid #E0E5E3;
    }
    .fc .fc-daygrid-day-top{
        flex-direction: unset;
    }
    .calendar tr {
        border: 0.1rem solid #E0E5E3;

    }
    .fc-today-button{
        display: none!important;
    }
        .fc .fc-daygrid-day-number{
        padding: 0.8rem;
        font: 500 1.6rem / 1.7rem var(--GT);
        background: #F2F3F0;
        border-radius: 50%;
        color:#023D27;
        margin: 0.8rem 1.6rem;
            min-width: 3.4rem;
            text-align: center;
    }
    .calendar__place{
        font: 400 1.2rem / 1.3rem var(--GT)!important;
        color:#023D27;
        position: relative;
        padding-left: 1.2rem;
        text-transform: uppercase;
    }
    .calendar__place:after{
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        background: url(https://pear.blackbook.dev/wp-content/themes/Pear/img/loc-calendar.svg) center/1rem 1rem no-repeat;
    }
    .calendar__place.online:after{
        background: url(https://pear.blackbook.dev/wp-content/themes/Pear/img/online-calendar.svg) center/1rem 1rem no-repeat;
    }
    .calendar__info{
        padding: 0.8rem;
        display: flex;
        flex-direction: column;
        gap:0.6rem;
        border-radius: 1.2rem;
        background: #F2F3F0;
        transition: .2s ease;
    }
    .calendar__info:hover{
        background:#E0E5E3;
        transition: .2s ease;
    }
    .calendar__title{
        font: 500 1.6rem / 2rem var(--GT)!important;
        color:#023D27;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Обмеження до 3 рядків */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-word;
    }
    .calendar__info-wrap  .calendar__time{
        font: 400 1.2rem / 1.3rem var(--GT)!important;
        padding: 0.4rem 0.8rem;
        border-radius:  10rem;
        margin-bottom: 0.4rem ;
        background:#023D27 ;
        color:white;
    }

    .calendar__info-wrap.green  .calendar__time{
        background:#023D27 ;
        color:white;
    }
    .calendar__info-wrap.star  .calendar__time{
        background: linear-gradient(90deg, #FFE13C 0%, #FED21E 100%);
        position: relative;
        color:#023D27 ;
        padding-left: 2rem;
    }
    .calendar__info-wrap.star  .calendar__time:after{
        content: '';
        position: absolute;
        top: 50%;
        left: 0.8rem;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        background: url(https://pear.blackbook.dev/wp-content/themes/Pear/img/star-calendar.svg) center/1rem 1rem no-repeat;
    }
    .calendar__info-wrap.star .calendar__info {
        background:  #FFFAE8;
    }
    .calendar__info-wrap.star .calendar__info:hover {
        background:  #FFF3C9;
    }

    .calendar__info-wrap.passed  .calendar__time{
        background: #E6E9E4;
        position: relative;
        color:#023D27;
    }

    .calendar__info-wrap.passed .calendar__info {
        background: #F2F3F0;
    }
    .fc-h-event{
        background: transparent;
        border:none;
    }
    .fc-daygrid-day-events{
        display: flex;
        flex-direction: column;
        gap:2rem;
    }
    .fc .fc-daygrid-day.fc-day-today{
        background: transparent;
    }
    .fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number{
        background: #089946;
        color:white;
    }

    .fc .fc-col-header-cell-cushion{
        font: 400 1.6rem / 1.7rem var(--GT)!important;
        text-transform: uppercase;
    }
    .calendar thead .fc-scrollgrid-sync-inner{
        text-align: left;
    }
    .fc .fc-col-header-cell-cushion{
        padding: 1.6rem 0.8rem;
    }
    .fc .fc-daygrid-day-frame{
     min-height: 21.4rem;
    }



    .fc .fc-daygrid-body {
        overflow: visible !important; /* Remove scroll behavior */
        max-height: none !important; /* Remove height limitations */
    }

    .fc .fc-daygrid-day-frame {
        min-height: 21.4rem;
    }

    .fc .fc-daygrid-day-events {
        overflow: visible !important;
        max-height: none !important;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .fc .fc-daygrid-day {
        /*height: auto !important; !* Allow each day cell to grow based on content *!*/
        min-height: 21.4rem;
    }

    .fc .fc-daygrid-day-top {
        flex-direction: unset;
    }

    .fc .fc-daygrid-day-number {
        padding: 0.8rem;
        font: 500 1.6rem / 1.7rem var(--GT);
        background: #F2F3F0;
        border-radius: 50%;
        color: #023D27;
        margin: 0.8rem 1.6rem;
        min-width: 3.4rem;
        text-align: center;
    }

    .fc .fc-scroller-liquid-absolute {
        overflow: visible !important; /* Override scroller's default behavior */
    }







    .fc .fc-daygrid-day-events > .fc-event {
        white-space: normal; /* Ensure event text wraps if needed */
    }
    .fc-event {
        /*display: flex;*/
        /*align-items: center;*/
        /*padding: 0.2rem 0.4rem;*/
        /*border-radius: 0.5rem;*/
        /*font-size: 1.2rem;*/
        /*background-color: var(--event-bg-color, #089946); !* Динамічний колір *!*/
        /*color: #fff;*/
        /*text-align: center;*/
    }

    .fc-event .calendar__title {
        white-space: break-spaces;
    }

    .fc .fc-toolbar.fc-header-toolbar{
        display: flex;
        gap:0.4rem;
        align-items: center;
        padding: 1.2rem ;
        border-radius: 100rem;
        background: #F2F3F0;
        margin:0;
        /*margin: 1rem 0;*/
    }


    .fc-toolbar-title{
        margin: 0!important;
        min-width: 18rem;
        font: 400 2.4rem / 2.4rem var(--GT)!important;
        color:#023D27;
        text-align: center;
        letter-spacing: -0.02em;
    }
    .fc .fc-button-primary{
        margin: 0!important; ;
        background: transparent;
        width: 3.2rem;
        height: 3.2rem;
        color:#023D27;
        border: none;
    }
    .fc .fc-button-primary:hover{
        background: transparent;
        color:#023D27;
    }
    .fc .fc-button-primary:focus{
        box-shadow: none;
    }

    /*.fc .fc-col-header {*/
    /*    position: sticky;*/
    /*    top: 0;*/
    /*    z-index: 100;*/
    /*    background: #F2F3F0; !* Колір фону для заголовка *!*/
    /*    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); !* Легка тінь для відділення заголовка *!*/
    /*}*/

    /*!* Додаткові стилі для заголовків колонок *!*/
    /*.fc .fc-col-header-cell {*/
    /*    font: 500 1.6rem / 1.7rem var(--GT)!important;*/
    /*    text-transform: uppercase;*/
    /*    padding: 1.6rem 0.8rem;*/
    /*    text-align: center;*/
    /*}*/

    .fc .fc-col-header {
        position: sticky;
        top: 12.6rem;
        z-index: 1000;
        background: white;
        border-bottom: 0.1rem solid  #E0E5E3;
    }
    .fc .fc-toolbar.fc-header-toolbar{
        position: sticky;
        top:8rem;
        /*background: white;*/
    }
    .fc .fc-scrollgrid-section-header.fc-scrollgrid-section-sticky > *{
        top:16rem;
    }
    .fc .fc-scrollgrid-section-header.fc-scrollgrid-section-sticky > *:after{
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        height: 100%;
        width: 100vw;
        background-color: white;
    }
    .fc .fc-col-header-cell {
        font: 500 1.6rem / 1.7rem var(--GT)!important;
        text-transform: uppercase;
        padding: 1.6rem 0.8rem;
        text-align: center;
    }
    .calendar__header{
        background: white;
        position: sticky;
        top:5.8rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 10;
        padding: 3rem 0 2rem;
    }
    .calendar__header:after{
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        height: 100%;
        width: 100vw;
        z-index: -1;
        background-color: white;
    }
    @media only screen and (max-width: 666px){
        .fc .fc-list-empty-cushion{
            font: 500 1.8rem / 2.4rem var(--GT);
        }
        .fc-toolbar-chunk{
            margin: 2rem auto;
        }
        .fc-toolbar-chunk{
            display: block;
            margin: 0;
            padding: 0!important;
        }
        .fc-event .calendar__time{
            margin-right: 0;
        }
        .fc .fc-toolbar{
            gap:0.4rem;
            padding: 1.2rem;
            border-radius: 100rem;
            background: #F2F3F0;
            margin: 2.4rem auto;
            position: sticky;
            top: 2rem;
        }
        .fc-direction-ltr .fc-list-table .fc-list-event-graphic{
            display: none;
        }

        .fc-list-day-cushion {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            justify-content: center;
        }

        .fc-list-day-text {
            font-size: 1.4rem;
            font-weight: bold;
        }

        .fc-list-day-side-text {
            font-size: 1.2rem;
            text-transform: uppercase;
        }

        .fc-list-day-cushion a {
            white-space: nowrap;
        }
        .fc-direction-ltr .fc-list-day-text{
            float: unset;
            font: 500 1.6rem / 1.8rem var(--GT);
            padding: 0.8rem ;
            min-width: 3.4rem;

            background: #F2F3F0;
            border-radius: 50%;

        }
        .fc-theme-standard .fc-list-day-cushion{
            background: transparent;
            padding: 1.6rem 0 4rem;
            position: relative;
        }
        .fc-theme-standard .fc-list-day-cushion:after{
            content: '';
            position: absolute;
            bottom: 3.2rem;
            width: 100vw;
            height: 0.1rem;
            left: 50%;
            transform: translateX(-50%);
            background:#E0E5E3;
        }

        .calendar tr, .fc-theme-standard .fc-list, .fc-theme-standard td, .fc-theme-standard th{
            border: none;
        }
        .fc .fc-list-table td{
            padding: 0;
        }
        .fc-direction-ltr .fc-list-day-side-text, .fc-direction-rtl .fc-list-day-text{
            font: 500 2.4rem / 2.4rem var(--GT);
        }
        .calendar__info-wrap{
            margin-bottom: 2.4rem;
        }
        .calendar tr:hover{
            background:transparent;
        }
        .fc .fc-toolbar.fc-header-toolbar{
            width: 100%;

        }
        .calendar__header{
            flex-direction: column;
            top:5rem;
            gap:1rem

        }
        .fc .fc-list-sticky .fc-list-day > *{
            top:18rem;
            z-index: 10;
        }
        .fc .fc-list-sticky .fc-list-day > *:before{
            content: '';
            position: absolute;
            bottom: 0;
            width: 100vw;
            height: 100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: -1;
            background-color: white;
        }
    }
</style>
<script>
    const seminars = <?php echo json_encode($seminars); ?>;

    // const seminars = [
    //     {
    //         "url": "https://pear.blackbook.dev/seminar/qualitatsmanagement-beauftragter/",
    //         "dates": [
    //             { "date": "12/12/2024", "time": "14:00 - 16:30" }
    //         ],
    //         "title": "123 Qualitätsmanagement - Beauftragter",
    //         "plave": "online",
    //         "color": "yellow"
    //     },
    //     {
    //         "url": "https://pear.blackbook.dev/seminar/aufbau-und-inhalt-des-produktionslenkungsplans-seminar-fur-anwender/",
    //         "dates": [
    //             { "date": "29/12/2024", "time": "14:00 - 16:30" },
    //             { "date": "30/12/2024", "time": "12:00 - 16:30" },
    //             { "date": "31/12/2024", "time": "10:00 - 12:30" }
    //         ],
    //         "title": "Seminar für Anwender",
    //         "plave": "Bamberg",
    //         "color": "green"
    //     },
    //     {
    //         "url": "https://pear.blackbook.dev/seminar/aufbau-und-inhalt-des-produktionslenkungsplans-seminar-fur-anwender/",
    //         "dates": [
    //             { "date": "28/12/2024", "time": "9:00 - 12:30" },
    //             { "date": "29/12/2024", "time": "9:00 - 12:30" },
    //             { "date": "30/12/2024", "time": "10:00 - 11:30" },
    //             { "date": "31/12/2024", "time": "12:00 - 15:30" }
    //         ],
    //         "title": "Aufbau und Inhalt des Produktionslenkungsplans – Seminar für Anwender",
    //         "plave": "Bamberg",
    //         "color": "grey"
    //     },
    //     {
    //         "url": "https://pear.blackbook.dev/seminar/qualitatsmanagement-beauftragter/",
    //         "dates": [
    //             { "date": "29/12/2024", "time": "09:00 - 16:30" }
    //         ],
    //         "title": "Qualitätsmanagement-Beauftragter",
    //         "plave": "online",
    //         "color": "yellow"
    //     },
    //     {
    //         "url": "https://pear.blackbook.dev/seminar/qualitatsmanagement-beauftragter/",
    //         "dates": [
    //             { "date": "26/12/2024", "time": "14:00 - 16:30" }
    //         ],
    //         "title": "Qualitätsmanagement-Beauftragter",
    //         "plave": "online",
    //         "color": "yellow"
    //     }
    // ];


    function updateListDayFormat() {
        console.log(11113345666)
        if (window.innerWidth < 666) {
            console.log('before')
            document.querySelectorAll('.fc-list-day-cushion').forEach(function (cushion) {
                const dayText = cushion.querySelector('.fc-list-day-text');
                console.log('after')
                console.log(11111134555669999, dayText)
                const daySideText = cushion.querySelector('.fc-list-day-side-text');

                if (dayText) {
                    const fullDateText = dayText.getAttribute('aria-label');
                    console.log(1234, fullDateText)

                    if (fullDateText) {
                        const dateParts = fullDateText.match(/(\d{1,2})\. (\w+) (\d{4})/);

                        if (dateParts) {
                            const day = parseInt(dateParts[1], 10);

                            console.log(4444, day)

                            dayText.textContent = `${day}`;

                            if (daySideText) {
                                const monthName = dateParts[2];
                                const year = parseInt(dateParts[3], 10);

                                const months = [
                                    'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
                                    'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
                                ];

                                const monthIndex = months.indexOf(monthName);
                                const date = new Date(year, monthIndex, day);

                                if (!isNaN(date.getTime())) {
                                    const dayShort = date.toLocaleDateString('de-DE', { weekday: 'short' });
                                    daySideText.textContent = dayShort;
                                }
                            }
                        }
                    }
                }
            });



            // document.querySelectorAll('.fc-list-day-cushion').forEach(function (cushion) {
            //     const dayText = cushion.querySelector('.fc-list-day-text');
            //     const daySideText = cushion.querySelector('.fc-list-day-side-text');
            //
            //     if (dayText && daySideText) {
            //         try {
            //             const fullDateText = dayText.getAttribute('aria-label');
            //
            //             if (fullDateText) {
            //                 const dateParts = fullDateText.match(/(\d{1,2})\. (\w+) (\d{4})/);
            //
            //                 if (dateParts) {
            //                     const day = parseInt(dateParts[1], 10);
            //                     const monthName = dateParts[2];
            //                     const year = parseInt(dateParts[3], 10);
            //
            //                     const months = [
            //                         'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
            //                         'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
            //                     ];
            //
            //                     const monthIndex = months.indexOf(monthName);
            //
            //                     if (monthIndex !== -1) {
            //                         const date = new Date(year, monthIndex, day);
            //
            //                         if (!isNaN(date.getTime())) {
            //                             const dayNumber = date.getDate();
            //                             const dayShort = date.toLocaleDateString('de-DE', { weekday: 'short' }); // Скорочений день тижня
            //
            //                             dayText.textContent = `${dayNumber}`;
            //                             daySideText.textContent = `${dayShort}`;
            //                         }
            //                     }
            //                 }
            //             }
            //         } catch (error) {
            //             console.error('Error formatting mobile calendar date:', error);
            //         }
            //     }
            // });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        console.log('🔄 Початок генерації подій для календаря');

        const events = seminars.flatMap(seminar => {
            const firstDate = seminar.dates[0]?.date || null;
            const lastDate = seminar.dates[seminar.dates.length - 1]?.date || null;

            return seminar.dates.map((date, index) => {
                const start = date.date.split('/').reverse().join('-');
                const end = seminar.dates.length > 1 && index === seminar.dates.length - 1
                    ? new Date(new Date(start).setDate(new Date(start).getDate() + 1)).toISOString().split('T')[0]
                    : null;

                return {
                    title: seminar.title,
                    start: start,
                    end: end,
                    url: seminar.url,
                    textColor: '#fff',
                    allDay: true,
                    display: 'block',
                    extendedProps: {
                        time: date.time,
                        plave: seminar.plave,
                        isFirstDay: index === 0,
                        color: seminar.color,
                        firstDate: firstDate,
                        lastDate: lastDate
                    }
                };
            });
        });
        console.log('✅ Генерація подій завершена');
        console.log(events);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: window.innerWidth < 666 ? 'listMonth' : 'dayGridMonth',
            locale: 'de',
            height: 'auto',
            firstDay: 1,
            dayHeaderFormat: { weekday: 'short' },
            displayEventTime: false,
            events: events,
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            titleFormat: {
                year: 'numeric',
                month: 'long'
            },
                eventContent: function (arg) {
                    const { extendedProps } = arg.event;

                    const eventStart = arg.event.start.toISOString().split('T')[0];
                    const eventEnd = arg.event.end
                        ? new Date(arg.event.end - 1).toISOString().split('T')[0] // Останній день
                        : eventStart;

                    const firstDate = extendedProps.firstDate
                        ? extendedProps.firstDate.split('/').reverse().join('-')
                        : null;
                    const lastDate = extendedProps.lastDate
                        ? extendedProps.lastDate.split('/').reverse().join('-')
                        : null;

                    let positionClass = '';

                    if (firstDate && lastDate) {
                        if (eventStart === firstDate) {
                            positionClass = 'start';
                        } else if (eventStart === lastDate) {
                            positionClass = 'end';
                        } else if (eventStart > firstDate && eventStart < lastDate) {
                            positionClass = 'middle';
                        }
                    } else {
                        positionClass = 'single';
                    }

                    const starClass = extendedProps.color === 'yellow' ? 'star' : '';
                    const greenClass = extendedProps.color === 'green' ? 'green' : '';
                    const isPassed = extendedProps.color === 'grey' ? 'passed' : '';

                    const today = new Date().toISOString().split('T')[0];
                    // const isPassed = eventStart < today ? 'passed' : '';

                    let timeContent = '';

                    if (firstDate && lastDate && firstDate !== lastDate) {
                        const firstDateParts = extendedProps.firstDate.split('/');
                        const lastDateParts = extendedProps.lastDate.split('/');

                        const startDay = parseInt(firstDateParts[0], 10);
                        const endDay = parseInt(lastDateParts[0], 10);
                        const startMonth = new Date(`${firstDateParts[2]}-${firstDateParts[1]}-${firstDateParts[0]}`)
                            .toLocaleDateString('de-DE', { month: 'short' });
                        const year = firstDateParts[2];

                        const dateRange = `${startDay}-${endDay} ${startMonth} ${year}`;

                        timeContent = `
            <div class="calendar__time">
                <span class="calendar__time-date">${dateRange}</span> ${extendedProps.time || ''}
            </div>
        `;
                    }
                    else if (extendedProps.time) {
                        timeContent = `
            <div class="calendar__time">
                ${extendedProps.time}
            </div>
        `;
                    }

                    const titleAndPlace = `
        <div class="calendar__info">
            <div class="calendar__place ${extendedProps.plave === 'online' ? 'online' : ''}">
                ${extendedProps.plave}
            </div>
            <div class="calendar__title">${arg.event.title}</div>
        </div>
    `;

                    return {
                        html: `
            <div class="calendar__info-wrap ${positionClass} ${starClass} ${greenClass} ${isPassed}">
                ${timeContent}
                ${titleAndPlace}
            </div>
        `
                    };
                },



            eventClick: function (info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    console.log(`🔗 Відкриття URL: ${info.event.url}`);
                    window.open(info.event.url, '_blank');
                }
            }
        });

        calendar.render();

        // updateListDayFormat()
        setTimeout(updateListDayFormat, 10);

        window.addEventListener('resize', function () {
            console.log('🔄 Зміна розміру вікна');
            if (window.innerWidth < 666) {
                calendar.changeView('listMonth');
            } else {
                calendar.changeView('dayGridMonth');
            }
            updateListDayFormat();
        });
        document.querySelector('.fc-prev-button').addEventListener('click', function () {
            console.log(444)
            setTimeout(updateListDayFormat, 10);
        });

        document.querySelector('.fc-next-button').addEventListener('click', function () {
            console.log(555)
            setTimeout(updateListDayFormat, 10);
        });

        // Знаходимо елемент з класом 'fc-header-toolbar'
        const fcHeaderToolbar = document.querySelector('.fc-header-toolbar');

        if (fcHeaderToolbar) {
            // Створюємо обгортку <div class="calendar__header"></div>
            const wrapper = document.createElement('div');
            wrapper.className = 'calendar__header';

            // Обгортаємо елемент
            fcHeaderToolbar.parentNode.insertBefore(wrapper, fcHeaderToolbar);
            wrapper.appendChild(fcHeaderToolbar);

            // Знаходимо елемент з класом 'calendar__section-title'
            const sectionTitle = document.querySelector('.calendar__section-title');
            if (sectionTitle) {
                // Переміщуємо його всередину wrapper на початок
                wrapper.insertBefore(sectionTitle, wrapper.firstChild);
            }
        }
    });


</script>



<?php wp_reset_postdata(); ?>
<?php (new Calendar_Page_Banner_Section())->render()?>
<?php (new Calendar_Page_Form_Section())->render()?>
<?php get_footer(); ?>

