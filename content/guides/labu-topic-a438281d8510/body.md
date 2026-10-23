## Tiny example

Unified iterative traversal idea: stack pairs `(node, state)`.

States example:

- `0` = first seen → push right/left / rearrange, set state to visit-later
- `1` = ready to output

By choosing when to output, one framework emits pre/in/post.


## How

1. Push `(root, WHITE)`
2. Pop; if WHITE, push children/self with new colors in the order you need
3. If BLACK (or visit state), append to answer


## Trap

Pushing children without re-pushing self for the visit phase in in/post.

**Fix:** Self must return to the stack in the visit state for those orders.

**Time:** O(n) · **Space:** O(h)

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
