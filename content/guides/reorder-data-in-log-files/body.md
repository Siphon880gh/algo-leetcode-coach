## A key that separates the two kinds

For each log, `ident, rest = log.split(' ', 1)`.

- Letter log (`rest[0]` is a letter): key `(0, rest, ident)`.
- Digit log: key `(1,)`, so all digit logs tie with each other.

Sort with that key. A stable sort keeps the digit logs in their original order.

Do not sort digit logs by content; their order must not change. Do not compare letter logs by the whole string; the identifier only breaks ties.

Time: O(n · L log n)  
Space: O(n · L)

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
