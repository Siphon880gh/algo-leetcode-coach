## Undo the insertions

For each character `ch`:

- Push `ch`.
- If the stack ends with `a, b, c`, pop three times.

Return whether the stack is empty.

Each "abc" insertion can be undone in reverse, and deleting the innermost complete "abc" first is always safe, which is what the stack does.

An equivalent check: on `c`, the top must be `b` and the one below it `a`; otherwise return false early.

Do not repeatedly call `replace("abc", "")` on the string; that is O(n²). Do not only count letters; `"cba"` has equal counts but is invalid.

Time: O(n)  
Space: O(n)

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
