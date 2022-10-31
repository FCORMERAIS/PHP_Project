<?php 
header('Content-type: text/css; charset:UTF-8');
?>

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
  display: block;
  transition: color 0.3s ease 0s;
}

.overlay a:hover,
.overlay a:focus {
  color: #0088a9;
}
.overlay .close {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
  color: #edf0f1;
}

.overlay a {
font-size: 20px;
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
}

a:focus {
  outline: none;
}

button::-moz-focus-inner {
  border: 0;
}


/* box */
.box {
  display: flex;
  margin-top : 20%;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  padding: 0 4rem 2rem;
}

.box:not(:first-child) {
  height: 45rem;
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

/* using :target */
/*
when users will click/enter button(link) browser will add a #id in a url and when that happens we'll show our users the modal that contains that id.
*/
.modal-container:target {
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

.modal__text {
  padding: 0 4rem;
  margin-top: 4rem;

  font-size: 1.6rem;
  line-height: 2;
}

.modal__btn {
  margin-top: 4rem;
  padding: 1rem 1.6rem;
  border: 1px solid var(--border-color);
  border-radius: 100rem;

  color: inherit;
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


/* link-... */
.link-1 {
  font-size: 1.8rem;

  color: var(--light);
  background: var(--background);
  box-shadow: .4rem .4rem 2.4rem .2rem var(--shadow-1);
  border-radius: 100rem;
  padding: 1.4rem 3.2rem;

  transition: .2s;
}

.link-1:hover,
.link-1:focus {
  transform: translateY(-.2rem);
  box-shadow: 0 0 4.4rem .2rem var(--shadow-2);
}

.link-1:focus {
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