<template>
    <div class="container">
        <div class="row blue">
            <div class="col-4"><h1 class="dispay-block text-center text-white mt-1">
                Skill Analysis</h1></div>
            <div class="col-6">
                <input type="text" v-model="param" placeholder="Поиск" aria-label="Search" class="form-control mr-sm-2 mt-2">
            </div>
            <div class="col-2">
                <form class="form-inline mr-auto mb-2">
                    <button @click="search" type="button" class="btn btn-white btn-rounded btn-md my-0 waves-effect waves-light mt-2">Поиск
                    </button>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row white">
                <h4 class="m-3">Найдено {{total.toLocaleString()}} резюме</h4>
            </div>
        </div>
        <div class="container">
            <div class="row white">
                <div class="col-8 p-3">
                    <div v-for="item in objects">

                        <div class="container">
                            <div class="row">
                                <div class="col-10">

                                    <h4><a :href="item.link">{{item.profession}}</a></h4>
                                    <small>{{item.age}} лет</small>
                                    <h6>{{item.town.title}}</h6>
                                    <h4 v-if="item.payment">{{item.payment}}
                                        <span v-if="item.currency==='rub'">₽</span>
                                        <span v-if="item.currency==='eur'">€</span>
                                        <span v-if="item.currency==='usd'">$</span>
                                    </h4>
                                    <span v-if="s.month!==0" class="badge badge-primary m-1" v-for="s in item.skillex"> {{s.skill}}: {{s.monthstr}} </span>
                                </div>
                                <div class="col-2">
                                    <div class="text-center" v-if="item.photo">
                                        <img :src="item.photo" class="rounded" alt="photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-4 p-3">
                    <div>
                        <h4 class="mt-3">Местоположение</h4>
                        <div>
                            <md-autocomplete v-model="town" :md-options="towns" @md-changed="getTowns" @md-selected="selectTown">
                                <label>Город</label>
                                <template slot="md-autocomplete-item" slot-scope="{item}">{{ item.title }}</template>
                            </md-autocomplete>
                        </div>
                        <h4 class="mt-3">Опыт работы (месяцы)</h4>
                        <div>
                            <md-field>
                                <label>От</label>
                                <md-input v-model="start_ex" type="number" ></md-input>
                            </md-field>
                            <md-field>
                                <label>До</label>
                                <md-input v-model="end_ex" type="number" ></md-input>
                            </md-field>
                        </div>
                        <h4>Возраст</h4>
                        <md-field>
                            <label>От</label>
                            <md-input v-model="age_from" type="number" ></md-input>
                        </md-field>
                        <md-field>
                            <label>До</label>
                            <md-input v-model="age_to" type="number" ></md-input>
                        </md-field>
                        <h4>Зарплата</h4>
                        <md-field>
                            <label>От</label>
                            <md-input v-model="payment_from" type="number" ></md-input>
                        </md-field>

                        <md-field>
                            <label>До</label>
                            <md-input v-model="payment_to" type="number" ></md-input>
                        </md-field>
                        <h4>Тип занятости</h4>
                        <div class="md-layout-item">
                            <md-field>
                                <md-select v-model="type_of_work">
                                    <md-option value="6">Полный день</md-option>
                                    <md-option value="10">Неполный день</md-option>
                                    <md-option value="12">Частичная занятость</md-option>
                                    <md-option value="13">Сменный график</md-option>
                                    <md-option value="7">Времення работа</md-option>
                                    <md-option value="9">Вахта</md-option>
                                </md-select>
                            </md-field>
                        </div>
                        <!--<button type="button" @click="addSelSkill" class="btn btn-white btn-rounded btn-md my-0 waves-effect waves-light mt-2">Добавить</button>-->
                        <h4 class="mt-3">Навыки</h4>
                        <!--<p v-if="skill_chips.length === 0"> Пока нет заданных навыков</p>-->
                        <md-chips class="md-primary" v-model="skill_chips" md-placeholder="Добавить навык...">
                            <label>Навыки</label>
                        </md-chips>

                        <div class="md-layout-item">
                            <md-field>
                                <label for="critery">Способ сортировки по навыкам</label>
                                <md-select v-model="critery" name="movie" id="movie">
                                    <md-option value=true>По приоритету</md-option>
                                    <md-option value=false>Сумме навыков</md-option>
                                </md-select>
                            </md-field>
                        </div>

                        <!--<md-chip md-deletable class="md-primary" v-for="(chip,index) in skill_chips" :key="chip" @md-deletable="deleteChip(index)">{{chip}}</md-chip>-->
                        <div>
                            <button @click="search" class="btn blue white-text mt-3">Поиск</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['resumes'],
        data() {
            return{
                critery: true,
                experience: null,
                resultPost: false,
                alertMessage: null,
                start_ex: null,
                end_ex: null,
                payment_from: null,
                payment_to: null,
                age_from: null,
                age_to: null,
                type_of_work: null,
                post: null,
                param: this.param,
                skill_name: this.skill_name,
                mounth: this.mounth,
                skill_chips:[],
                town: "Санкт-Петербург",
                towns: [
                    {
                        title: "Санкт-Петербург",
                        id: 14
                    },
                    {
                        title: "Москва",
                        id: 4
                    },],
                items: [
                    {
                        name: "Программист-стажер",
                        city: "Санк-Петербург",
                        salary: "По договоренности",
                        old: 45
                    },
                    {
                        name: "Программист",
                        city: "Санк-Петербург",
                        salary: "По договоренности",
                        old: 26
                    }
                ],
                objects: this.resumes.objects,
                townId: 14,
                total: this.resumes.total
            }
        },
        computed:{
        },
        methods: {
            search(){
                let uskills = this.param;
                for (let i = 0; i<this.skill_chips.length;i++) {
                   uskills = uskills + " " + this.skill_chips[i];
                }
                axios.post(location.href, {
                    keyword: uskills,
                    experience_from: this.start_ex,
                    experience_to: this.end_ex,
                    age_from: this.age_from,
                    age_to: this.age_to,
                    payment_from: this.payment_from,
                    payment_to: this.payment_to,
                    type_of_work: this.type_of_work,
                    town: this.townId
                }).then(response => {
                    this.objects = response.data.objects;
                    this.total = response.data.total;
                    this.alertMessage = 'Вакансия успешно сохранена';
                    this.post = true;
                    for(let i=0;i<this.objects.length;i++){
                        let skills = [];
                        for(let j=0;j<this.skill_chips.length;j++){
                            let history = [];

                            for(let l=0;l<this.objects[i].work_history.length;l++) {
                                let is_find = false;

                                if (!is_find && this.objects[i].work_history[l].achievements != null && this.objects[i].work_history[l].achievements.toUpperCase().indexOf(this.skill_chips[j].toUpperCase()) > 0) {
                                    is_find = true;
                                    history.push(this.objects[i].work_history[l]);
                                }
                                if (!is_find && this.objects[i].work_history[l].profession != null && this.objects[i].work_history[l].profession.toUpperCase().indexOf(this.skill_chips[j].toUpperCase()) > 0) {
                                    is_find = true;
                                    history.push(this.objects[i].work_history[l]);
                                }
                                if (!is_find && this.objects[i].work_history[l].work != null && this.objects[i].work_history[l].work.toUpperCase().indexOf(this.skill_chips[j].toUpperCase()) > 0) {
                                    is_find = true;
                                    history.push(this.objects[i].work_history[l]);
                                }
                            }

                            if(history.length === 1){
                                if(history[0].monthend == null){
                                    history[0].monthend = new Date().getMonth()+1;
                                }
                                if(history[0].yearend  == null){
                                    history[0].yearend  = new Date().getFullYear();
                                }
                            }

                            for(let i=0;i<history.length-1;i++) {
                                if(history[i].monthend == null){
                                    history[i].monthend = new Date().getMonth()+1;
                                }
                                if(history[i].yearend  == null){
                                    history[i].yearend  = new Date().getFullYear();
                                }
                                if(history[i+1].monthend == null){
                                    history[i+1].monthend = new Date().getMonth()+1;
                                }
                                if(history[i+1].yearend  == null){
                                    history[i+1].yearend  = new Date().getFullYear();
                                }

                                if(history[i].yearend === history[i+1].yearend && history[i].monthend === history[i+1].monthend){
                                        //history[i+1].yearbeg = history[i].yearbeg;
                                        //history[i+1].monthbeg = history[i].monthbeg;
                                        history.splice(i,1);
                                        --i;
                                } else if((history[i].yearend > history[i+1].yearend || (history[i].yearend === history[i+1].yearend && history[i].monthend > history[i+1].monthend)) && (history[i].yearbeg < history[i+1].yearbeg || (history[i].yearbeg === history[i+1].yearbeg && history[i].monthbeg < history[i+1].monthbeg))){
                                    history[i+1].yearbeg = history[i].yearbeg;
                                    history[i+1].monthbeg = history[i].monthbeg;
                                    history[i+1].yearend = history[i].yearend;
                                    history[i+1].monthend = history[i].monthend;
                                    history.splice(i,1);
                                    --i;
                                } else if((history[i].yearend > history[i+1].yearend || (history[i].yearend === history[i+1].yearend && history[i].monthend > history[i+1].monthend)) && (history[i].yearbeg > history[i+1].yearbeg || (history[i].yearbeg === history[i+1].yearbeg && history[i].monthbeg > history[i+1].monthbeg))){
                                    history[i+1].yearend = history[i].yearend;
                                    history[i+1].monthend = history[i].monthend;
                                    history.splice(i,1);
                                    --i;
                                } else if(history[i].yearbeg === history[i+1].yearend && history[i].monthbeg === history[i+1].monthend){
                                    history[i+1].yearend = history[i].yearend;
                                    history[i+1].monthend = history[i].monthend;
                                    history.splice(i,1);
                                    --i;
                                }
                            }

                            let exmonth = 0;

                            for(let i=0;i<history.length;i++){
                                let temp = (history[i].monthend - history[i].monthbeg)
                                        + (history[i].yearend - history[i].yearbeg)*12;
                                temp++;
                                exmonth = exmonth + temp;
                            }

                            let titles = ['год', 'года', 'лет'];
                            let cases = [2, 0, 1, 1, 1, 2];
                            let number = Math.floor(exmonth/12);
                            let yearStr = "";
                            if(number !== 0){
                                yearStr = number+" "+titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
                            }
                            titles = ['месяц', 'месяца', 'месяцев'];
                            cases = [2, 0, 1, 1, 1, 2];
                            number = exmonth % 12;
                            let mothStr = "";
                            if(number !== 0){
                                mothStr =  number+" "+titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
                            }
                            let exmonthStr = yearStr + ' ' + mothStr;
                            let temp = {
                                skill: this.skill_chips[j],
                                month: exmonth,
                                monthstr: exmonthStr
                            };
                            skills.push(temp);
                        }
                        //skills.push();
                        this.$set(this.objects[i], 'skillex', skills);
                    }
                    if(this.critery==='true'){
                        this.objects.sort(
                            function (a,b) {
                                for(let i = 0;i < b.skillex.length; i++){
                                    if(b.skillex[i].month === a.skillex[i].month){
                                        if(i+1===b.skillex.length){
                                            return b.skillex[i].month - a.skillex[i].month
                                        }
                                    } else {
                                        return b.skillex[i].month - a.skillex[i].month;
                                    }
                                }
                            }
                        );
                    } else {
                        this.objects.sort(
                            function (a,b) {
                                let asum = 0;
                                for(let i = 0; i < a.skillex.length; i++){
                                    asum += a.skillex[i].month;
                                }
                                let bsum = 0;
                                for(let i = 0; i < b.skillex.length; i++){
                                    bsum += b.skillex[i].month;
                                }
                                return bsum - asum;
                            }
                        );
                    }
                }).catch(error => {
                    this.alertMessage = 'Не удалось зарегистрироваться';
                    this.post = true;
                });

            },
            getTowns(searchTerm){
                axios.post(location.origin+'/towns', {
                    keyword: searchTerm
                }).then(response => {
                    this.towns = response.data.objects;
                }).catch(error => {

                })
            },
            selectTown(value){
                this.town = value.title;
                this.townId = value.id;
            },
            addSelSkill(){
                let is_find = false;
                for (let i = 0; i<this.skill_chips.location;i++) {
                    if (this.skill_chips[i]===this.skill_chips) {
                        is_find = true;
                    }
                }
                if (!is_find) {
                    this.skill_chips.push(this.skill_name);
                }
                this.skill_name = "";
            },
            deleteChip(index){
                this.skill_chips.splice(index,1);
            }
        }
    }
</script>

<style scoped>

</style>