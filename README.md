Behancer Statamic Plugin
========================
*by [Philip Meissner](http://lou.pe)* 

Statamic plugin using Behance API to pull in a single project data or a list of projects.

## Usage:

1. [Register](https://www.behance.net/dev) your Behance app.
2. Place you Client ID and Client Secret in the `_config/bundles/behancer/behancer.yaml` file.
3. Pass the plugin your project id to `behancer:project` or the user id to `behance:listing`. All of the Behance data is converted into YAML that is accessible to your templates.

### {{ behancer:project id="" }}

If you want to pull in your project's hi-res images, use the following code:

```
{{ behancer:project id="{{ project_id }}" }}
  {{ modules }}
    {{ sizes }}
      <img src="{{ max_1240 }}">
    {{ /sizes }}
  {{ /modules }}
{{ /behancer:project }}
```

### {{ behancer:listing user="" }}

Want to show the cover images of all of your projects, try this:

```
{{ behancer:listing user="creative-loupe" }}
  {{ listing }}
    {{ covers }}
      <img src="{{ 404 }}">
    {{ /covers }}
  {{ /listing }}
{{ /behancer:listing }}
```

## Notes

The plugin caches the data once a day so you shouldn't hit Behance's API data limits (150 requests per hour). However, if you edit a Behance project you will have to wait 24 hours to see the change on your site, or wipe out your cache if you are impatient. 
