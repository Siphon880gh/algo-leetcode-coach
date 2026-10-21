## Endpoint lengths

1. `L[x − l] = L[x + r] = l + r + 1` where `l = L[x − 1]`, `r = L[x + 1]`.
2. `cnt −= (l == m) + (r == m)`; `cnt += (l + r + 1 == m)`.
3. If `cnt > 0`, `ans = step`.

`[3,5,1,2,4]`, m = 1 → 4. `[3,1,5,4,2]`, m = 2 → −1.

Shortcut: if `m == n`, the answer is n. Do not rescan the string each step (O(n²)).

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
