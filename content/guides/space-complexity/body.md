## Tiny example

Function copies an input array of length `n` into a new array, then loops.

- Input storage: usually **not** charged as extra space
- New array: **O(n)** auxiliary
- Recursion depth `h`: **O(h)** stack space counts

If you only use a few scalars, auxiliary space is **O(1)**.


## How

1. Decide what “extra” means (beyond the input)
2. Add arrays/maps you allocate
3. Add maximum recursion depth / explicit stacks


## Trap

Claiming a recursive DFS is O(1) space because you “did not new an array”.

**Fix:** The call stack is memory. Depth h ⇒ O(h) space.

**Report:** auxiliary space as n grows (and mention stack if recursive).

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
