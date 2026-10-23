## Tiny example

`int8` two’s complement:

- `5` → `00000101`
- `-1` → `11111111`
- Adding `1` to `01111111` (127) wraps to `-128` on overflow

Floats: `0.1 + 0.2` may not equal `0.3` exactly — binary fractions.

Algorithms: prefer integers for indices/counts; know wrap rules in contests (`mod 2^32` languages).


## How

1. Use two’s complement mental model for signed ints
2. Check overflow on sums/products
3. Compare floats with tolerance or avoid them for exactness


## Trap

Assuming right-shift on signed negatives always fills zeros (logical shift).

**Fix:** Know arithmetic vs logical shift in your language.

**Bug class:** overflow and float equality

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
