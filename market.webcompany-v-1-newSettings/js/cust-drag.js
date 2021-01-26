// const tasksListElement = document.querySelector(".tasks__list");
// const taskElements = tasksListElement.querySelectorAll(".tasks__item");
// const btn = tasksListElement.querySelectorAll(".btn-drag");

// let dataNmr = function () {
//   for (let i = 0; i < taskElements.length; i++) {
//     taskElements[i].setAttribute("data-nmr", `${i}`);
//   }
// };
// dataNmr();

// btn.forEach((items) => {
//   // items.addEventListener("mouseover", () => {
//   items.addEventListener("mousedown", () => {
//     for (const task of taskElements) {
//       task.draggable = true;
//     }
//   });

//   // items.addEventListener("mouseout", () => {
//   items.addEventListener("mouseup", () => {
//     for (const task of taskElements) {
//       task.draggable = "";
//     }
//   });
// });

// // for (const task of taskElements) {
// //   task.draggable = true;
// // }

// tasksListElement.addEventListener("dragstart", (evt) => {
//   evt.target.classList.add("selected");
// });

// tasksListElement.addEventListener("dragend", (evt) => {
//   evt.target.classList.remove("selected");
// });

// const getNextElement = (cursorPosition, currentElement) => {
//   const currentElementCoord = currentElement.getBoundingClientRect();
//   const currentElementCenter = currentElementCoord.y + currentElementCoord.height / 2;

//   const nextElement = cursorPosition < currentElementCenter ? currentElement : currentElement.nextElementSibling;

//   return nextElement;
// };

// tasksListElement.addEventListener("dragover", (evt) => {
//   evt.preventDefault();

//   const activeElement = tasksListElement.querySelector(".selected");
//   const currentElement = evt.target;
//   const isMoveable = activeElement !== currentElement && currentElement.classList.contains("tasks__item");

//   if (!isMoveable) {
//     return;
//   }

//   const nextElement = getNextElement(evt.clientY, currentElement);

//   if ((nextElement && activeElement === nextElement.previousElementSibling) || activeElement === nextElement) {
//     return;
//   }

//   tasksListElement.insertBefore(activeElement, nextElement);
// });

//вариант 2
// const DragonDrop = window.DragonDrop;

// const demo1 = document.getElementById('test');
// const dragonDrop = new DragonDrop(demo1, {
//   handle: '.btn-drag',
//   // announcement: {
//   //   grabbed: el => `${el.querySelector('span').innerText} grabbed`,
//   //   dropped: el => `${el.querySelector('span').innerText} dropped`,
//   //   reorder: (el, items) => {
//   //     const pos = items.indexOf(el) + 1;
//   //     const text = el.querySelector('span').innerText;
//   //     return `The rankings have been updated, ${text} is now ranked #${pos} out of ${items.length}`;
//   //   },
//   //   cancel: 'Reranking cancelled.'
//   // }
// });

// вариант 3 jquery-ui
const tasksListElement = document.querySelector(".tasks__list");
const taskElements = tasksListElement.querySelectorAll(".tasks__item");
const btn = tasksListElement.querySelectorAll(".btn-drag");

let dataNmr = function () {
  for (let i = 0; i < taskElements.length; i++) {
    taskElements[i].setAttribute("data-nmr", `${i + 1}`);
  }
};
dataNmr();

$(".tasks__list").sortable({
  // containment: "parent",
  axis: "y",
  handle: '.handle',
  // sort: function (event, ui) {
  //   $("#itemId").text(ui.item.attr("data-nmr"));
  // },
  // change: function (event, ui) {
  //   $("#pos").text($(".tasks__list *").index(ui.placeholder));
  // },
});
