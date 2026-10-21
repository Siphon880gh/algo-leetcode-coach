## Two kinds of unmatched brackets

`open = 0`, `adds = 0`. For each character:

- `(`: `open += 1`.
- `)`: if `open > 0`, `open −= 1`; else `adds += 1` (this one needs an extra `(`).

Return `adds + open`.

Each unmatched `)` and each unmatched `(` needs exactly one partner, and matching greedily as early as possible leaves the fewest unmatched.

Do not return `|count('(') − count(')')|`; `")("` has equal counts but needs 2. Do not keep an actual stack; a counter is enough.

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
