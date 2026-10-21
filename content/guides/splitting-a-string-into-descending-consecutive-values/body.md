## DFS on the next value

1. For each first cut `j` (leaving at least one more piece): `go(j, int(s[:j]))`.
2. `go(i, prev)`: if `i == n`, true. For each end `e`: `v = int(s[i:e])`; if `v == prev − 1` and `go(e, v)`, true.

`"1234"` → false. `"050043"` → true (`"05"`, `"004"`, `"3"` → 5, 4, 3). `"9080701"` → false.

Leading zeros are allowed: `"0090089"` splits into 90 and 89.

Time: O(n²) branches per level, tiny for n ≤ 20  
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
