<?php /* Template Name: Calendar page */ ?>
<?php get_header(); ?>

<?php 
$args = $args = array(
    'post_type' => 'seminar',
    'posts_per_page' => 99999999,
);
$query = new WP_Query($args);
$seminars = [];
foreach ($query->posts as $post) {
   
    if (has_term('exklusiv','seminar_type',$post->ID)) {
        $color = 'yelow';
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
    .calendar__time{
        font: 400 1.2rem / 1.3rem var(--GT)!important;
        background:#023D27 ;
        color:white;
        padding: 0.4rem 0.8rem;
        border-radius:  10rem;
        margin-bottom: 0.4rem ;
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
    /*.calendar thead tr{*/
    /*    border-color: transparent;*/
    /*}*/
    /*.fc-theme-standard th, .fc-col-header{*/
    /*    border: none!important;*/
    /*}*/
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
        min-height: auto; /* Adjust to fit content dynamically */
    }

    .fc .fc-daygrid-day-events {
        overflow: visible !important; /* Prevent any overflow clipping */
        max-height: none !important; /* Ensure content expands dynamically */
        display: flex;
        flex-direction: column;
        gap: 0.6rem; /* Adjust spacing between events */
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

</style>
<script>
    // const seminars = <?php echo json_encode($seminars); ?>;

    const seminars = [
        {
            "url": "https://pear.blackbook.dev/seminar/qualitatsmanagement-beauftragter/",
            "dates": [
                { "date": "12/12/2024", "time": "14:00 - 16:30" }
            ],
            "title": "123 Qualitätsmanagement-Beauftragter",
            "plave": "online",
            "color": "yellow"
        },
        {
            "url": "https://pear.blackbook.dev/seminar/aufbau-und-inhalt-des-produktionslenkungsplans-seminar-fur-anwender/",
            "dates": [
                { "date": "29/12/2024", "time": "14:00 - 16:30" },
                { "date": "30/12/2024", "time": "12:00 - 16:30" },
                { "date": "31/12/2024", "time": "10:00 - 12:30" }
            ],
            "title": "Aufbau und Inhalt des Produktionslenkungsplans – Seminar für Anwender",
            "plave": "Bamberg",
            "color": "green"
        },
        {
            "url": "https://pear.blackbook.dev/seminar/aufbau-und-inhalt-des-produktionslenkungsplans-seminar-fur-anwender/",
            "dates": [
                { "date": "29/12/2024", "time": "10:00 - 12:30" },
                { "date": "30/12/2024", "time": "12:00 - 16:30" },
                { "date": "31/12/2024", "time": "10:00 - 12:30" }
            ],
            "title": "Aufbau und Inhalt des Produktionslenkungsplans – Seminar für Anwender",
            "plave": "Bamberg",
            "color": "grey"
        },
        {
            "url": "https://pear.blackbook.dev/seminar/qualitatsmanagement-beauftragter/",
            "dates": [
                { "date": "26/12/2024", "time": "14:00 - 16:30" }
            ],
            "title": "Qualitätsmanagement-Beauftragter",
            "plave": "online",
            "color": "yellow"
        }
    ];
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        const events = seminars.flatMap(seminar => {
            return seminar.dates.map((date, index) => {
                const start = date.date.split('/').reverse().join('-'); // Форматування дати до ISO
                const end = seminar.dates.length > 1 && index === seminar.dates.length - 1
                    ? new Date(new Date(start).setDate(new Date(start).getDate() + 1)).toISOString().split('T')[0]
                    : null;

                return {
                    title: seminar.title,
                    start: start,
                    end: end,
                    url: seminar.url,
                    textColor: '#fff',
                    extendedProps: {
                        time: date.time,
                        plave: seminar.plave,
                        isFirstDay: index === 0,
                        color: seminar.color // Ensure color is passed here
                    }
                };
            });
        });

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'de',
            height: 'auto',
            firstDay: 1,
            dayHeaderFormat: { weekday: 'short' },
            dayCellContent: function (arg) {
                const dayNumber = arg.date.getDate().toString().padStart(2, '0'); // Додає ведучі нулі до дати
                return { html: `<div>${dayNumber}</div>` };
            },
            events: events,
            eventContent: function (arg) {
                const { extendedProps } = arg.event;
                const starClass = extendedProps.color === 'yellow' ? 'star' : ''; // Check color here

                // Визначення, чи подія вже минула
                const eventDate = new Date(arg.event.start);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Скидання часу для порівняння лише дат

                const isPassed = eventDate < today ? 'passed' : '';

                // Відображаємо title і place тільки на перший день
                const titleAndPlace = extendedProps.isFirstDay
                    ? `
                  <div class="calendar__info ">
                      <div class="calendar__place ${extendedProps.plave === 'online' ? 'online' : ''}" style="font-weight: bold; font-size: 1.1em;">
                        ${extendedProps.plave}
                      </div>
                      <div class="calendar__title">${arg.event.title}</div>
                  </div>
                `
                    : '';

                const time = extendedProps.time
                    ? `<div class="calendar__time">${extendedProps.time}</div>`
                    : '';

                return {
                    html: `<div class="calendar__info-wrap ${starClass} ${isPassed}">${time}${titleAndPlace}</div>`
                };
            },
            eventClick: function (info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.open(info.event.url, '_blank');
                }
            }
        });

        calendar.render();
    });


</script>
<?php wp_reset_postdata(); ?>
<?php (new Calendar_Page_Banner_Section())->render()?>
<?php (new Calendar_Page_Form_Section())->render()?>
<?php get_footer(); ?>