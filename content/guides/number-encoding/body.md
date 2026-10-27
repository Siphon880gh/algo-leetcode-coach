## Tiny example

Two's complement in `int8`:

- `5` is stored as `00000101`.
- `-1` is stored as `11111111`.
- Adding `1` to `01111111` (127) overflows and wraps around to `-128`.

Floating-point numbers: `0.1 + 0.2` may not equal `0.3` exactly, because these decimals have no exact binary fraction.

In algorithms, prefer integers for indices and counts, and know the wraparound rules in contests (some languages wrap modulo 2^32).

## How

1. Think of signed integers as two's complement.
2. Check for overflow in sums and products.
3. Compare floats with a tolerance, or avoid them when you need exact results.

## Trap

Assuming that right-shifting a negative signed number always fills with zeros (a logical shift).

**Fix:** Know whether your language uses an arithmetic or a logical shift.

**Common bugs:** overflow and comparing floats for equality

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
