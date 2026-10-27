## Tiny example

Typical sizes in a common language:

| Type | Typical size | Note |
|------|---------------|------|
| `bool` | 1 byte | True or false |
| `int32` | 4 bytes | Overflows past about ±2.1 billion (2³¹) |
| `float64` | 8 bytes | Approximate real numbers |
| `char` | 1 to 4 bytes | Depends on the text encoding |

An array of 1000 `int32` values needs about 4000 bytes for the values themselves, plus a small header.

When an integer overflows, it either wraps around or raises an error. An algorithm that adds up large numbers must use a wider type or work modulo some number.

## How

1. Know the size of each element when you estimate memory.
2. Know what happens on integer overflow in your language.
3. Never compare floats for exact equality. Use a tolerance.

## Trap

Using floating-point numbers for money or exact counts, for example as hash set keys.

**Fix:** Use integers for exact values, such as counting money in cents. Floats are approximate.

**Space:** element size × n, plus overhead

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
