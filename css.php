<?php 
header('Content-type: text/css; charset:UTF-8');
?>

@import "https://fonts.googleapis.com/css?family=Josefin+Sans:400,700";

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.careful {
    background-color:red;
    margin-top : 25%;
    border-radius : 45px;
    borde
}

.corps {
  --light: hsl(220, 50%, 90%);
  --primary: hsl(255, 30%, 55%);
  --focus: hsl(210, 90%, 50%);
  --border-color: hsla(0, 0%, 100%, .2);
  --global-background: hsl(220, 25%, 10%);
  --background: linear-gradient(to right, hsl(210, 30%, 20%), hsl(255, 30%, 25%));
  --shadow-1: hsla(236, 50%, 50%, .3);
  --shadow-2: hsla(236, 50%, 50%, .4);

  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Open Sans', sans-serif;
  color: var(--light);
  background: var(--global-background);
}

.tempo{
    color:#24252a;
}

.title{
  margin-top:2%;
  text-align: center;
  font-family: "Montserrat", sans-serif;
}

.connect{
    position:absolute;
    left:90%;
    padding: 9px 25px;
    font-family: "Montserrat", sans-serif;
    background-color: rgba(0, 136, 169, 1);
    border: none;
    color : rgba(227, 227, 227 ,1);
    border-radius: 50px;
    cursor: pointer;
    transition: background-color 0.3s ease 0s;
}

.connect:hover{
    background-color: rgba(0, 136, 169, 0.2);
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 10%;
    background-color: #24252a;
}

.logo {
    cursor: pointer;
    display: flex;
}

.nav__links a,
.cta,
.overlay__content a {
    font-family: "Montserrat", sans-serif;
    font-weight: 500;
    color: #edf0f1;
    text-decoration: none;
}

.nav__links {
    list-style: none;
    display: flex;
}

.nav__links li {
    padding: 0px 20px;
}

.nav__links li a {
    transition: color 0.3s ease 0s;
}

.nav__links li a:hover {
  color: #0088a9;
}

.cta {
  padding: 9px 25px;
  background-color: rgba(0, 136, 169, 1);
  border: none;
  border-radius: 50px;
  cursor: pointer;
  transition: background-color 0.3s ease 0s;
}

.cta:hover {
  background-color: rgba(0, 136, 169, 0.8);
}

/* Mobile Nav */

.menu {
  display: none;
  position:absolute;
  left:82%;
}

.policeAugment {
    font-size: 36px;
}

.overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  background-color: #24252a;
  overflow-x: hidden;
  transition: width 0.5s ease 0s;
}

.overlay--active {
  width: 100%;
}

.container {
  margin-top : 3%;
  display: flex;
  justify-content: space-around;
}

.overlay__content {
  display: flex;
  height: 100%;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.overlay a {
  padding: 15px;
  font-size: 36px;
  transition: color 0.3s ease 0s;
}

.overlay .btna:hover,
.overlay .btna:focus {
  color: #0088a9;
}

.overlay .close:hover,
.overlay .close:focus {
  color: #0088a9;
  cursor: pointer;
}

.overlay .close {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
  color: #edf0f1;
}

.overlay a {
    font-size: 36px;
}

.overlay .close {
    font-size: 40px;
    top: 15px;
    right: 35px;
}

.menu {
display: initial;
}


a,
a:link {
  margin-top:3%;
  font-family: inherit;
  text-decoration: none;
  color : white;
}

a:focus {
  outline: none;
}

button::-moz-focus-inner {
  border: 0;
}

.box2 {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

/* box */
.box {
  height: 50px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 0 4rem 2rem;
}

.box__title {
  font-size: 10rem;
  font-weight: normal;
  letter-spacing: .8rem;
  margin-bottom: 2.6rem;
}

.box__title::first-letter {
  color: var(--primary);
}

.box__p,
.box__info,
.box__note {
  font-size: 1.6rem;
}

.box__info {
  margin-top: 6rem;
}

.box__note {
  line-height: 2;
}


/* modal */
.modal-container {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 10;

  display: none;
  justify-content: center;
  align-items: center;

  width: 100%;
  height: 100%;

  /* --m-background is set as inline style */
  background: var(--m-background);
}

.modal-container2 {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 10;

  display: none;
  justify-content: center;
  align-items: center;

  width: 100%;
  height: 100%;

  /* --m-background is set as inline style */
  background: var(--m-background);
}

/* using :target */
/*
when users will click/enter button(link) browser will add a #id in a url and when that happens we'll show our users the modal that contains that id.
*/
.modal-container:target {
  display: flex;
}

.modal-container2:target {
  display: flex;
}

.modal {
  width: 60rem;
  padding: 4rem 2rem;
  border-radius: .8rem;

  color: var(--light);
  background: var(--background);
  box-shadow: var(--m-shadow, .4rem .4rem 10.2rem .2rem) var(--shadow-1);
  position: relative;

  overflow: hidden;
}

.modal__title {
  font-size: 3.2rem;
}

.modal__title2 {
  position: absolute;
  top: 0%;
  right: 38%;
  font-size: 3.2rem;
}

.modal__text {
  padding: 0 4rem;
  margin-top: 4rem;

  font-size: 1.6rem;
  line-height: 2;
}

.modal__btn {
  margin-top: 4rem;
  margin-left : 18rem;
  padding: 1rem 1.6rem;
  border: 1px solid var(--border-color);
  border-radius: 100rem;
  color: darkred;
  background: transparent;
  font-size: 1.4rem;
  font-family: inherit;
  letter-spacing: .2rem;
  transition: .2s;
  cursor: pointer;
}

.modal__btn:nth-of-type(1) {
  margin-right: 1rem;
}

.modal__btn:hover,
.modal__btn:focus {
  background: var(--focus);
  border-color: var(--focus);
  transform: translateY(-.2rem);
}

.modal__btn2 {
  margin-top: 4rem;
  margin-left : 18rem;
  padding: 1rem 1.6rem;
  border: 1px solid var(--border-color);
  border-radius: 100rem;
  color: rgb(0, 139, 79);
  background: transparent;
  font-size: 1.4rem;
  font-family: inherit;
  letter-spacing: .2rem;
  transition: .2s;
  cursor: pointer;
}

.modal__btn2:nth-of-type(1) {
  margin-right: 1rem;
}

.modal__btn2:hover,
.modal__btn2:focus {
  background: var(--focus);
  border-color: var(--focus);
  transform: translateY(-.2rem);
}

/* link-... */
.link-1 {
  background: var(--background);
  box-shadow: .4rem .4rem 2.4rem .2rem var(--shadow-1);
  border-radius: 100rem;
}



.link-1:hover,
.link-1:focus {
  transform: translateY(-.2rem);
  color:darkred;
  box-shadow: 0 0 4.4rem .2rem var(--shadow-2);
}


.link-1:focus {
  box-shadow:
    0 0 4.4rem .2rem var(--shadow-2),
    0 0 0 .4rem var(--global-background),
    0 0 0 .5rem var(--focus);
}

.link-12 {
  background: var(--background);
  box-shadow: .4rem .4rem 2.4rem .2rem var(--shadow-1);
  border-radius: 100rem;
}



.link-12:hover,
.link-12:focus {
  transform: translateY(-.2rem);
  color:rgb(0, 139, 0);
  box-shadow: 0 0 4.4rem .2rem var(--shadow-2);
}


.link-12:focus {
  box-shadow:
    0 0 4.4rem .2rem var(--shadow-2),
    0 0 0 .4rem var(--global-background),
    0 0 0 .5rem var(--focus);
}

.link-2 {
  width: 4rem;
  height: 4rem;
  border: 1px solid var(--border-color);
  border-radius: 100rem;

  color: inherit;
  font-size: 2.2rem;

  position: absolute;
  top: 2rem;
  right: 2rem;

  display: flex;
  justify-content: center;
  align-items: center;

  transition: .2s;
}

.link-2::before {
  content: '×';

  transform: translateY(-.1rem);
}
.link-2:hover,
.link-2:focus {
  background: var(--focus);
  border-color: var(--focus);
  transform: translateY(-.2rem);
}

.abs-site-link {
  position: fixed;
  bottom: 20px;
  left: 20px;
  color: hsla(0, 0%, 1000%, .6);
  font-size: 1.6rem;
}

.card {
  height: 400px;
  width: 300px;
  perspective: 600px;
  transition: 0.5s;
}
.card:hover .card-front1 {
  transform: rotateX(-180deg);
}
.card:hover .card-front2 {
  transform: rotateX(-180deg);
}
.card:hover .card-front3 {
  transform: rotateX(-180deg);
}
.card:hover .card-back {
  transform: rotateX(0deg);
}

.card-front1 {
  height: 30em;
  width: 130%;
  background-image: url("https://intra-science.anaisequey.com/images/stories/observations/bio-polaire%20(17).JPG");
  background-position: 50% 50%;
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #000000;
  backface-visibility: hidden;
  transform: rotateX(0deg);
  transition: 0.5s;
  border-radius: 75px;
}

.card-front2 {
  height: 30em;
  width: 130%;
  background-image: url("https://planet-vie.ens.fr/sites/default/files/pages/mig/Manchot%20empereur_CC-BY-SA_Samuel%20Blanc_Wikimedia.jpg");
  background-position: 50% 50%;
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #000000;
  backface-visibility: hidden;
  transform: rotateX(0deg);
  transition: 0.5s;
  border-radius: 75px;
}

.card-front3 {
  height: 30em;
  width: 130%;
  background-image: url(data:image/jpeg;base64,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);
  background-position: 50% 50%;
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #000000;
  backface-visibility: hidden;
  transform: rotateX(0deg);
  transition: 0.5s;
  border-radius: 75px;
}

.card-back {
  height: 30em;
  width: 130%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #000000;
  backface-visibility: hidden;
  transform: rotateX(180deg);
  transition: 0.5s;
  color: #ffffff;
  text-align: center;
  border-radius: 75px;
}
.card-back h2 {
  margin: 60% auto 35% auto;
  font-size: 26px;
}
.card-back h2 span {
  font-size: 20px;
}
.card-back a {
  height: 20px;
  width: 20px;
  padding: 5px 5px;
  border-radius: 4px;
  line-height: 20px;
}
.card-back a:hover {
  color: #000000;
  background-color: #fff;
}

.github{
  display: inline-block;
  font: normal normal normal 14px/1 FontAwesome;
  font-size: inherit;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
}

.github:before {
  content: "\f099";
}

.backpage{
  position: absolute;
  display: flex;
  top: 81%;
}

@media (max-width: 800px) and (min-width: 0px){
  .backpage{
    position: absolute;
    display: contents;
    top: 81%;
  } 
}

.input {
	position:relative;
	font-size: 1.5em;
	background: linear-gradient(21deg, #10abff, #1beabd);
	padding: 3px;
	display: inline-block;
	border-radius: 9999em;
}
.input:focus + span {
  opacity: 1;
  transform: scale(1);
}	

.input > *:not(span) {
  position: relative;
  display: inherit;
  border-radius: inherit;
  margin: 0;
  border: none;
  outline: none;
  padding: 0 .325em;
  z-index: 1;
}

input {
  border:none;
	font-family: inherit;
	line-height:inherit;
	color:#2e3750;
	min-width:12em;
} 
