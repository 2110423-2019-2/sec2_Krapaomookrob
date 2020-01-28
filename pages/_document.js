import Document, { Head, Main, NextScript } from 'next/document'
import { ThemeProvider } from "@chakra-ui/core"

export default class MyDocument extends Document {
  static getInitialProps({ renderPage }) {
    const page = renderPage((App) => (props) =>
      (<ThemeProvider><App {...props} /></ThemeProvider>)
    )
    return {...page}
  }

  render() {
    return (
      <html>
        <Head>
          <link rel="stylesheet" href="/_next/static/style.css" />
        </Head>

        <body>
          <Main />
          <NextScript />
        </body>
      </html>
    )
  }
}
