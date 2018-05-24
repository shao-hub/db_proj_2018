var deleteLinks = document.querySelectorAll('.delete_confirm');

for (var i = 0; i < deleteLinks.length; i++)
{
    deleteLinks[i].addEventListener('click', function(event){
        event.preventDefault();

        var choice = confirm("Are You Sure ?");

        if (choice) {
            window.location.href = this.getAttribute('href');
        }
    });
}