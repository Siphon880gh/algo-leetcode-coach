## No need to rotate

1. `cur = arr[0]`, `streak = 0`.
2. For each next `x`: if `x > cur`, `cur = x`, `streak = 1`; else `streak += 1`. If `streak == k`, return `cur`.
3. Return `cur` (the maximum).

`[2,1,3,5,4,6,7]`, k = 2 → 5. `[3,2,1]`, k = 10 → 3.

Do not simulate the queue for k up to 10^9; after one pass the maximum wins forever.

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
