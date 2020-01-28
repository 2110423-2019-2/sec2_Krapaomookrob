import React, { Component } from 'react'
import '../styles/main.scss'
import { Button } from "@chakra-ui/core"

export default class extends Component {
  render() {
    return (
      <div>
        <main>
          <Button>I just consumed some ⚡️Chakra!</Button>
        </main>
      </div>
    )
  }
}
