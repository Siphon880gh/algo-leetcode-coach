## Run sums

1. Track `mx` of the current run.
2. On `colors[i] == colors[i−1]`: `ans += min(mx, t[i])`, `mx = max(mx, t[i])`. Else `mx = t[i]`.

`"abaac"`, `[1,2,3,4,5]` → 3. `"abc"` → 0. `"aabaa"`, `[1,2,3,4,1]` → 2.

Do not remove the cheaper of each adjacent pair independently; keep exactly the run maximum.

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
