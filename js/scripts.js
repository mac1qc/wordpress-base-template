"use strict";

let drilldownDepth = 0;

document.querySelectorAll('.menu-icon').forEach((btnMenu) => {
  btnMenu.addEventListener('click',(e) => {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById(btnMenu.getAttribute('data-toggle')).classList.add('off-canvas-open');
    document.getElementsByTagName('body')[0].classList.add('open-modal');
    closeElement();
    return false;
  });
});

document.querySelectorAll('.drilldown ul.sub-menu').forEach((thisDrilldown) => {
  let liTag = document.createElement('li');
  liTag.innerHTML = '<a href="#" class="back-drilldown">Retour</a>';
  thisDrilldown.prepend(liTag);
});

document.querySelectorAll('.drilldown .menu-item-has-children > a').forEach((thisDrilldownLink) => {
  thisDrilldownLink.addEventListener('click',(e) => {
    e.preventDefault();
    if(drilldownDepth === 0){
      thisDrilldownLink.closest('.drilldown').style.transform = 'translateX(-100%)';
      drilldownDepth = 1;
    }else if(drilldownDepth === 1){
      thisDrilldownLink.closest('.drilldown').style.transform = 'translateX(-200%)';
      drilldownDepth = 2;
    }
    return false;
  });
});

document.querySelectorAll('.drilldown .back-drilldown').forEach((thisBackDrilldown) => {
  thisBackDrilldown.addEventListener('click',(e) => {
    e.preventDefault();
    if(drilldownDepth === 1){
      thisBackDrilldown.closest('.drilldown').style.transform = 'translateX(0%)';
      drilldownDepth = 0;
    }else if(drilldownDepth === 2){
      thisBackDrilldown.closest('.drilldown').style.transform = 'translateX(-100%)';
      drilldownDepth = 1;
    }
    return false;
  });
});
  
document.querySelectorAll('a').forEach((thisElement) => {
  thisElement.addEventListener('click', (e) => {
    let thisHref = thisElement.getAttribute('href');
    if(thisHref.match(/\.jpg|\.png|\.gif|\.svg|\.webp|-scaled/gi)){
      let res           = thisHref.replace(/\.jpg|\.png|\.gif|\.svg|\.webp|-scaled/gi, ''),
          thisChildSrc  = thisElement.getElementsByTagName('img')[0].getAttribute('src');
      if(thisChildSrc.includes(res)){
        e.preventDefault();
        e.stopPropagation();
        let divTag = document.createElement('div');
        divTag.innerHTML = '<button class="close-button" aria-label="Fermer la fenêtre" type="button" data-close><span class="hide">Fermer la fenêtre</span></button><img src="'+thisHref+'" alt="" />';
        divTag.classList.add('modal');
        document.getElementsByTagName('body')[0].classList.add('open-modal');
        document.getElementsByTagName('body')[0].append(divTag);
        closeElement();
        return false;
      }
    }
  });
});

const accordions = document.querySelectorAll('.wp-block-gutenberg-custom-blck-accordion');
if(accordions.length) {
  accordions.forEach((thisAccordion) => {
    let thisAccordionTitles = thisAccordion.querySelectorAll('.accordion-title');
    thisAccordionTitles.forEach((thisTitle) => {
      thisTitle.addEventListener('click',() => {
        if(thisTitle.classList.contains('open')) {
          thisTitle.classList.remove('open');
        } else {
          let targetOpen = thisAccordion.getElementsByClassName('open')[0];
          if(targetOpen !== undefined){
            targetOpen.classList.remove('open');
          }
          thisTitle.classList.add('open');
        }
      });
    });
  });
}

const tabsContainer = document.querySelectorAll('.wp-block-gutenberg-custom-blck-tab');
if(tabsContainer.length){
  let tabIncrement = 0;
  tabsContainer.forEach((tabContainer) => {
    let divTagTab       = document.createElement('div'),
        divTagContent   = document.createElement('div'),
        tabTitle        = tabContainer.querySelectorAll('.accordion-title'),
        tabContent      = tabContainer.querySelectorAll('.accordion-content'),
        tabTitleList    = '',
        tabContentList  = '';
    divTagTab.classList.add('tab-button-container');
    divTagContent.classList.add('tab-content-container');
    tabTitle.forEach((thisTitle,index) => {
      tabTitleList += (index === 0)?'<span class="tab-title tab-active" data-target="tab-'+tabIncrement+'-'+index+'">'+thisTitle.innerText+'</span>':'<span class="tab-title" data-target="tab-'+tabIncrement+'-'+index+'">'+thisTitle.innerText+'</span>';
      thisTitle.remove();
    });
    tabContent.forEach((thisContent,index) => {
      tabContentList += (index === 0)?'<div class="tab-content tab-active" id="tab-'+tabIncrement+'-'+index+'">'+thisContent.innerHTML+'</div>':'<div class="tab-content" id="tab-'+tabIncrement+'-'+index+'">'+thisContent.innerHTML+'</div>';
      thisContent.remove();
    });
    divTagTab.innerHTML     = tabTitleList;
    divTagContent.innerHTML = tabContentList;
    tabContainer.append(divTagTab);
    tabContainer.append(divTagContent);
    tabContainer.querySelectorAll('.tab-title').forEach((thisTabTitle) => {
      thisTabTitle.addEventListener('click',() => {
        if(!thisTabTitle.classList.contains('tab-active')){
          let tabTarget = thisTabTitle.getAttribute('data-target');
          tabContainer.querySelector('.tab-title.tab-active').classList.remove('tab-active');
          tabContainer.querySelector('.tab-content.tab-active').classList.remove('tab-active');
          thisTabTitle.classList.add('tab-active');
          document.getElementById(tabTarget).classList.add('tab-active');
        }
      });
    });
    tabIncrement++;
  });
}

function closeElement(){
  let closerElements = document.querySelectorAll('.close-button, #wrapper');
  closerElements.forEach((closerElement) => {
    closerElement.addEventListener('click',(e) => {
      if(document.getElementsByTagName('body')[0].classList.contains('open-modal')){
        e.preventDefault();
        let offCanvas = document.getElementsByClassName('off-canvas-open')[0],
            modal     = document.getElementsByClassName('modal')[0];
        if(offCanvas !== undefined){
          offCanvas.classList.remove('off-canvas-open');
        }
        document.getElementsByTagName('body')[0].classList.remove('open-modal');
        if(modal !== undefined){
          modal.remove();
        }
        return false;
      }
    });
  });
}

let stickyElements = document.querySelectorAll('.sticky');
stickyElements.forEach((thisSticky) => {
  let thisStickyStuck = false;
  window.addEventListener('scroll', () => {
    if(thisSticky.offsetTop > thisSticky.parentNode.offsetTop){
      if(thisStickyStuck === false){
        thisStickyStuck = true;
        thisSticky.classList.add('is-stuck');
      }
    }else{
      thisStickyStuck = false;
      thisSticky.classList.remove('is-stuck');
    }
  });
});

function postAjax(url, data, success){
  let params  = (typeof data === 'string')?data:Object.keys(data).map(function(k){
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
          }).join('&'),
      xhr     = (window.XMLHttpRequest)?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP");
  xhr.open('POST', url);
  xhr.onreadystatechange = function(){
    if(xhr.readyState > 3 && xhr.status === 200){
      success(JSON.parse(xhr.responseText));
    }
  };
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(params);
  return xhr;
}
