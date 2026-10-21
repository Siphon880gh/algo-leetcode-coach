## lo and hi

Each `*` can be `(`, `)`, or empty, so the open count is a range `[lo, hi]`.

- `(`: `lo += 1`, `hi += 1`.
- `)`: `lo −= 1`, `hi −= 1`.
- `*`: `lo −= 1`, `hi += 1`.
- If `hi < 0`, return false: too many `)` even with every star as `(`.
- `lo = max(lo, 0)`: a negative count is never valid, so drop those choices.

At the end, return `lo == 0`.

An alternative uses two stacks of indexes, one for `(` and one for `*`, and matches each leftover `(` with a later `*`.

Do not treat `*` as a single fixed choice; `"(*))"` needs it to be `(` and `"(*)"` needs it empty. Do not skip clamping `lo`, or a run of stars early will hide an unmatched `(` later.

Time: O(n)  
Space: O(1)

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
