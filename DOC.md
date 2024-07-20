# UI Design Update for Avataaars Generator

In this guide, I will walk you through how we modified the existing code to position the avatar to the right, the form in the middle, and the title to the left.

## Step 1: Adding CSS Styles

## App.css

First, we updated the CSS styles to utilize flexbox and set up the layout of elements in rows with specific spacing. Here are the CSS styles we used:

```css
.main {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: flex-start;
  gap: 2rem;
  /* Ajusta este valor según tus preferencias */
}

.titleSection {
  flex: 1;
  margin-right: 1rem;
}

.formSection {
  flex: 1;
  margin-right: 1rem;
}

.avatarSection {
  flex: 1;
  text-align: center;
}

.canvasStyle {
  display: none;
}
```

## Step 2: Restructuring the TSX

## Main.tsx

Next, we went on to restructure the TSX to align with the new styles. Initially, we wrapped the title within a `header` element and assigned it the `titleSection` class. After that, we allocated distinct sections for the form and the avatar, designating them with the `formSection` and `avatarSection` classes, respectively.

Here is the streamlined Main.tsx code:

```jsx
<main role='main' className='main'>
        <header className='header clearfix'>
          <h2 style={{ color: '#6A39D7' }}>
            avataaars generator
            <Button
              type='submit'
              variant='secondary'
              style={{ marginLeft: '1rem' }}
              onClick={this.onRandom}
              className='pull-right'>
              <i className='fa fa-random' /> Random
            </Button>
          </h2>
        </header>
        <Helmet>
          <meta property='og:title' content={title} />
          <meta property='og:site_name' content='Avataaars Generator' />
          <meta property='og:url' content={document.location.href} />
          <meta property='og:image' content={imageURL} />
          <meta
            property='og:description'
            content='Avataaars Generator is a free online tool for generating your own avatar'
          />
          <meta name='twitter:card' content='photo' />
          <meta name='twitter:site' content='Avataaars Generator' />
          <meta name='twitter:title' content={title} />
          <meta name='twitter:image' content={imageURL} />
          <meta name='twitter:url' content={document.location.href} />
        </Helmet>
        <div className='formSection'>
          <AvatarForm
            optionContext={this.optionContext}
            avatarStyle={avatarStyle}
            displayingCode={displayComponentCode}
            displayingImg={displayComponentImg}
            onDownloadPNG={this.onDownloadPNG}
            onDownloadSVG={this.onDownloadSVG}
            onAvatarStyleChange={this.onAvatarStyleChange}
            onToggleCode={this.onToggleCode}
            onToggleImg={this.onToggleImg}
          />
        </div>

        <div className='avatarSection'>
          <div style={{ textAlign: 'center', marginBottom: '1rem' }}>
            <Avatar ref={this.onAvatarRef} avatarStyle={avatarStyle} />
          </div>
          {displayComponentImg ? (
            <ComponentImg avatarStyle={avatarStyle} />
          ) : null}
          {displayComponentCode ? (
            <ComponentCode avatarStyle={avatarStyle} />
          ) : null}
        </div>

        <canvas
          className='canvasStyle'
          width='528'
          height='560'
          ref={this.onCanvasRef}
        />
      </main>
```

## *Conclusion*

*With the above changes, we have achieved a UI where the title is on the left, the form is in the middle, and the avatar section is on the right, with equal spacing between each section,.*
