function getScript(source, callback) {
    var script = document.createElement("script")
    var prior = document.getElementsByTagName("script")[0]
    script.async = 1

    script.onload = script.onreadystatechange = function (_, isAbort) {
        if (isAbort || !script.readyState || /loaded|complete/.test(script.readyState)) {
            script.onload = script.onreadystatechange = null
            script = undefined
            if (!isAbort) if (callback) callback()
        }
    }
    script.src = source
    prior.parentNode.insertBefore(script, prior)
}

function post(url, data, callback) {
    var xhr = new XMLHttpRequest()
    xhr.open("POST", url, true)
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            callback(xhr.responseText)
        }
    }

    // Definindo o cabeçalho Content-Type com base no tipo de dados
    // if (typeof data === "object") {
    // 	// Se for um objeto, converter para JSON
    // 	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    // 	data = JSON.stringify(data);
    // }

    xhr.send(data)
}

document.querySelectorAll(".language").forEach(function (arg) {
    let wrapper = arg.querySelectorAll('div[class*="item"]')
    wrapper.forEach(function (item) {
        item.addEventListener("click", function () {
            let target = document.querySelector(".switch-language ." + item.className)
            if (!target.classList.contains("active")) {
                window.location.href = target.querySelector("a").href
            }
        })
    })
})

document.querySelector("header .menu").addEventListener("click", function () {
    let nav = document.querySelector("header nav")
    nav.classList.toggle("menu-active")
    if (nav.classList.contains("menu-active")) {
        document.querySelector("header .menu").classList.add("active-hover")
    } else {
        document.querySelector("header .menu").classList.remove("active-hover")
    }
})

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("main").style.minHeight = window.innerHeight - document.querySelector("header").offsetHeight - document.querySelector("footer").offsetHeight + "px"
    document.body.style.opacity = 1
})

window.addEventListener("resize", function () {
    document.querySelector("main").style.minHeight = window.innerHeight - document.querySelector("header").offsetHeight - document.querySelector("footer").offsetHeight + "px"
})

function lang(str, str2) {
    let lang = document.cookie.split("; ").indexOf("language=en") > -1 ? "en" : "pt"
    return lang == "en" ? str : str2
}

function popup(str, str2) {
    document.querySelector(".popup .text").innerHTML = lang(str, str2)
    document.querySelector(".popup-backdrop").classList.add("pop-show")
    setTimeout(function () {
        document.querySelector(".popup").classList.toggle("pop-show")
    }, 200)
    document.querySelector(".popup .close").addEventListener("click", function () {
        document.querySelector(".popup-backdrop").classList.remove("pop-show")
        setTimeout(function () {
            document.querySelector(".popup").classList.toggle("pop-show")
        }, 200)
    })
}

document.querySelectorAll(".eye").forEach(function (wrp) {
    let eyes = wrp.querySelectorAll(".eye img")
    eyes.forEach(function (arg, key) {
        arg.addEventListener("click", function () {
            if (key == 1) {
                arg.style.display = "none"
                arg.previousElementSibling.style.display = "block"
            } else {
                arg.style.display = "none"
                arg.nextElementSibling.style.display = "block"
            }

            if (arg.parentElement.parentElement.querySelector("input").type == "password") {
                arg.parentElement.parentElement.querySelector("input").type = "text"

                setTimeout(function () {
                    arg.parentElement.parentElement.querySelector("input").focus()
                }, 1)

                setTimeout(function () {
                    let cursorPosition = arg.parentElement.parentElement.querySelector("input").value.length
                    arg.parentElement.parentElement.querySelector("input").setSelectionRange(cursorPosition, cursorPosition)
                }, 2)
            } else {
                arg.parentElement.parentElement.querySelector("input").type = "password"

                setTimeout(function () {
                    arg.parentElement.parentElement.querySelector("input").focus()
                }, 1)

                setTimeout(function () {
                    let cursorPosition = arg.parentElement.parentElement.querySelector("input").value.length
                    arg.parentElement.parentElement.querySelector("input").setSelectionRange(cursorPosition, cursorPosition)
                }, 2)
            }
        })
    })
})

document.querySelectorAll(".wrapper-form input:not([type='radio']):not([type='checkbox'])").forEach((el) => {
    el.addEventListener("input", () => {
        if (el.value.length > 0) {
            el.parentElement.querySelector("label").style.opacity = 0
            el.parentElement.querySelector("label").style.zIndex = -2
        } else {
            el.parentElement.querySelector("label").style.opacity = 1
            el.parentElement.querySelector("label").style.zIndex = 0
        }
        submted ? validate(registerForm) : null

        if (el.name == "pswlgn") {
            checkpassword(el.value)
        }
    })
})

function initPasswordInputType(el) {
    if (el.dataset.initialized == null) {
        el.type = "password"
        el.dataset.initialized = true
    }
}

if (window.performance && window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
    window.addEventListener("load", function () {
        document.querySelectorAll(".wrapper-form input:not([type='radio']):not([type='checkbox'])").forEach((el) => {
            if (el.value.length > 0) {
                el.parentElement.querySelector("label").style.opacity = 0
                el.parentElement.querySelector("label").style.zIndex = -2
            }
        })
    })
}

window.addEventListener("load", function () {
    document.querySelectorAll(".wrapper-form input:not([type='radio']):not([type='checkbox'])").forEach((el) => {
        if (el.value.length > 0) {
            el.parentElement.querySelector("label").style.opacity = 0
            el.parentElement.querySelector("label").style.zIndex = -2
        }
    })
})

function terms() {
    let createTermsWrapper = document.createElement("div")
    createTermsWrapper.classList.add("terms")
    createTermsWrapper.innerHTML = document.querySelector(".terms").innerHTML
    popup(createTermsWrapper.innerHTML, createTermsWrapper.innerHTML)
}
