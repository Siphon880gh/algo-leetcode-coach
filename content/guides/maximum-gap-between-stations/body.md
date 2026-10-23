## Two greedy matches

1. suf[i] = latest station for worker i when workers i … n − 1 match from the right.
2. Scan left to right, giving worker i its earliest station pre; answer = max(suf[i + 1] − pre).
3. One worker → 0.

Examples → 3, 2, 4. Matched trying every assignment on 1,500 random cases.

Using one greedy assignment from the left for everyone: example 1 → 1 instead of 3.

Time: O(n + m)  
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
