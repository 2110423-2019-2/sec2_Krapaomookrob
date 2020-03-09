<template>
  <div class="frame p-4">
    <v-row class="fill-height">
      <v-col>
        <v-sheet height="64">
          <v-toolbar flat color="white">
            <v-btn outlined class="mr-4" color="grey darken-2" @click="setToday">
              Today
            </v-btn>
            <v-btn fab text small color="grey darken-2" @click="prev">
              <v-icon small>mdi-chevron-left</v-icon>
            </v-btn>
            <v-btn fab text small color="grey darken-2" @click="next">
              <v-icon small>mdi-chevron-right</v-icon>
            </v-btn>
            <v-toolbar-title>{{ title }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu bottom right>
              <template v-slot:activator="{ on }">
                <v-btn outlined color="grey darken-2" v-on="on">
                  <span>{{ typeToLabel[type] }}</span>
                  <v-icon right>mdi-menu-down</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item @click="type = 'day'">
                  <v-list-item-title>Day</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = 'week'">
                  <v-list-item-title>Week</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = 'month'">
                  <v-list-item-title>Month</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = '4day'">
                  <v-list-item-title>4 days</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </v-toolbar>
        </v-sheet>
        <v-sheet height="600">
          <v-calendar
            ref="calendar"
            v-model="focus"
            color="primary"
            :events="events"
            :event-color="getEventColor"
            :now="today"
            :type="type"
            @click:event="showEvent"
            @click:more="viewDay"
            @click:date="viewDay"
          ></v-calendar>
        </v-sheet>
      </v-col>
    </v-row>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    data: () => ({
      focus: '',
      today: new Date().toISOString().slice(0,10),
      type: 'month',
      typeToLabel: {
        month: 'Month',
        week: 'Week',
        day: 'Day',
        '4day': '4 Days',
      },
      start: null,
      end: null,
      selectedEvent: {},
      selectedElement: null,
      selectedOpen: false,
      events: [{"name":"Holiday","start":"2020-3-5 7:45","end":"2020-3-5 8:30","color":"indigo"},{"name":"PTO","start":"2020-3-18","end":"2020-3-19","color":"orange"},{"name":"PTO","start":"2020-3-14 11:0","end":"2020-3-14 11:30","color":"orange"},{"name":"Meeting","start":"2020-3-28 6:0","end":"2020-3-28 7:45","color":"orange"},{"name":"Holiday","start":"2020-3-14 12:0","end":"2020-3-14 12:30","color":"cyan"},{"name":"PTO","start":"2020-3-8 22:15","end":"2020-3-8 23:30","color":"deep-purple"},{"name":"Birthday","start":"2020-3-26 0:0","end":"2020-3-26 1:0","color":"grey darken-1"},{"name":"Party","start":"2020-3-24 15:30","end":"2020-3-24 17:0","color":"indigo"},{"name":"Conference","start":"2020-3-4 7:30","end":"2020-3-4 9:15","color":"orange"},{"name":"Conference","start":"2020-3-27","end":"2020-3-29","color":"blue"},{"name":"PTO","start":"2020-3-16 9:15","end":"2020-3-16 11:15","color":"deep-purple"},{"name":"Party","start":"2020-3-7 2:0","end":"2020-3-7 4:0","color":"cyan"},{"name":"Event","start":"2020-3-17 18:0","end":"2020-3-17 19:0","color":"green"},{"name":"Conference","start":"2020-3-30","end":"2020-3-31","color":"blue"},{"name":"Party","start":"2020-3-25 16:45","end":"2020-3-25 18:30","color":"green"},{"name":"PTO","start":"2020-3-6 13:30","end":"2020-3-6 14:0","color":"green"},{"name":"Event","start":"2020-3-23 12:15","end":"2020-3-23 14:0","color":"deep-purple"},{"name":"PTO","start":"2020-3-24 23:30","end":"2020-3-25 1:30","color":"deep-purple"},{"name":"Travel","start":"2020-3-15 14:15","end":"2020-3-15 15:0","color":"blue"},{"name":"Event","start":"2020-3-31 0:45","end":"2020-3-31 2:30","color":"indigo"},{"name":"Birthday","start":"2020-3-2 5:15","end":"2020-3-2 6:30","color":"deep-purple"},{"name":"Birthday","start":"2020-3-18","end":"2020-3-19","color":"indigo"},{"name":"Event","start":"2020-3-2 1:30","end":"2020-3-2 3:15","color":"deep-purple"},{"name":"Holiday","start":"2020-3-6","end":"2020-3-8","color":"grey darken-1"},{"name":"Party","start":"2020-3-16 10:45","end":"2020-3-16 12:15","color":"blue"},{"name":"Birthday","start":"2020-3-11 3:15","end":"2020-3-11 4:15","color":"blue"},{"name":"Event","start":"2020-3-21 2:45","end":"2020-3-21 3:45","color":"blue"},{"name":"Meeting","start":"2020-3-22 3:30","end":"2020-3-22 4:0","color":"grey darken-1"},{"name":"Birthday","start":"2020-3-11 16:0","end":"2020-3-11 16:30","color":"grey darken-1"},{"name":"Holiday","start":"2020-3-23 11:45","end":"2020-3-23 13:0","color":"blue"},{"name":"PTO","start":"2020-3-31 16:0","end":"2020-3-31 17:30","color":"orange"},{"name":"Birthday","start":"2020-3-30","end":"2020-3-30","color":"cyan"},{"name":"Birthday","start":"2020-3-31 9:30","end":"2020-3-31 11:15","color":"orange"},{"name":"Birthday","start":"2020-3-12","end":"2020-3-12","color":"green"},{"name":"Event","start":"2020-3-18","end":"2020-3-20","color":"cyan"},{"name":"Holiday","start":"2020-3-20 15:15","end":"2020-3-20 16:30","color":"indigo"},{"name":"Event","start":"2020-3-27 1:45","end":"2020-3-27 2:45","color":"cyan"},{"name":"Conference","start":"2020-3-13 13:30","end":"2020-3-13 14:0","color":"indigo"},{"name":"Meeting","start":"2020-3-16 17:45","end":"2020-3-16 19:15","color":"orange"},{"name":"Meeting","start":"2020-3-2 6:0","end":"2020-3-2 6:30","color":"indigo"},{"name":"Birthday","start":"2020-3-5","end":"2020-3-7","color":"green"},{"name":"Meeting","start":"2020-3-13 15:0","end":"2020-3-13 16:45","color":"deep-purple"},{"name":"Travel","start":"2020-3-20","end":"2020-3-22","color":"orange"},{"name":"Party","start":"2020-3-5","end":"2020-3-6","color":"green"},{"name":"Party","start":"2020-3-27 3:15","end":"2020-3-27 4:30","color":"deep-purple"},{"name":"Birthday","start":"2020-3-4","end":"2020-3-7","color":"blue"},{"name":"Conference","start":"2020-3-21 10:0","end":"2020-3-21 11:15","color":"orange"},{"name":"PTO","start":"2020-3-4 17:15","end":"2020-3-4 17:45","color":"orange"},{"name":"PTO","start":"2020-3-4","end":"2020-3-4","color":"green"}],
      colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
      names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party'],
    }),
    computed: {
      title () {
        const { start, end } = this
        if (!start || !end) {
          return ''
        }

        const startMonth = this.monthFormatter(start)
        const endMonth = this.monthFormatter(end)
        const suffixMonth = startMonth === endMonth ? '' : endMonth

        const startYear = start.year
        const endYear = end.year
        const suffixYear = startYear === endYear ? '' : endYear

        const startDay = start.day + this.nth(start.day)
        const endDay = end.day + this.nth(end.day)

        switch (this.type) {
          case 'month':
            return `${startMonth} ${startYear}`
          case 'week':
          case '4day':
            return `${startMonth} ${startDay} ${startYear} - ${suffixMonth} ${endDay} ${suffixYear}`
          case 'day':
            return `${startMonth} ${startDay} ${startYear}`
        }
        return ''
      },
      monthFormatter () {
        return this.$refs.calendar.getFormatter({
          timeZone: 'UTC', month: 'long',
        })
      },
    },
    mounted () {
      this.$refs.calendar.checkChange()
    },
    methods: {
      viewDay ({ date }) {
        this.focus = date
        this.type = 'day'
      },
      getEventColor (event) {
        return event.color
      },
      setToday () {
        this.focus = this.today
      },
      prev () {
        this.$refs.calendar.prev()
      },
      next () {
        this.$refs.calendar.next()
      },
      updateRange ({ start, end }) {
        const events = []

        const min = new Date(`${start.date}T00:00:00`)
        const max = new Date(`${end.date}T23:59:59`)
        const days = (max.getTime() - min.getTime()) / 86400000
        const eventCount = this.rnd(days, days + 20)

        for (let i = 0; i < eventCount; i++) {
          const allDay = this.rnd(0, 3) === 0
          const firstTimestamp = this.rnd(min.getTime(), max.getTime())
          const first = new Date(firstTimestamp - (firstTimestamp % 900000))
          const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
          const second = new Date(first.getTime() + secondTimestamp)

          events.push({
            name: this.names[this.rnd(0, this.names.length - 1)],
            start: this.formatDate(first, !allDay),
            end: this.formatDate(second, !allDay),
            color: this.colors[this.rnd(0, this.colors.length - 1)],
          })
        }

        this.start = start
        this.end = end
        this.events = events
      },
      nth (d) {
        return d > 3 && d < 21
          ? 'th'
          : ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'][d % 10]
      },
      rnd (a, b) {
        return Math.floor((b - a + 1) * Math.random()) + a
      },
      formatDate (a, withTime) {
        return withTime
          ? `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
          : `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`
      },
    },
  }
</script>
