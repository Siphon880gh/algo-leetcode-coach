## Tiny example

In a typical language:

| Type | Example width | Note |
|------|---------------|------|
| `bool` | 1 bit/byte | True/false |
| `int32` | 4 bytes | Overflow at ±2³¹ |
| `float64` | 8 bytes | Approx reals |
| `char` / code unit | 1–4 bytes | Encoding matters |

An array of 1000 `int32` needs ~4000 bytes of payload (plus header). Overflow wraps or errors — algorithms that sum large ranges must pick wider types or modular rules.


## How

1. Know element size when estimating memory
2. Know overflow behavior for integer algorithms
3. Do not assume float equality without tolerance


## Trap

Using float keys in a hash set for money/exact counts.

**Fix:** Prefer integers for exact counts; floats are approximate.

**Space:** element_size × n (+ overhead)

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
