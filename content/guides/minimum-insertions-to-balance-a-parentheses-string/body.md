## Counter instead of a stack

1. `(`: `need += 2`; if `need` is odd, `res += 1`, `need −= 1`.
2. `)`: `need −= 1`; if `need < 0`, `res += 1`, `need += 2`.
3. Return `res + need`.

`"(()))"` → 1. `"())"` → 0. `"))())("` → 3.

Do not count unmatched characters as in the classic version; `))` must be consecutive, which is why an odd `need` before a new `(` costs an insertion.

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
