## Sieve

1. M = max(nums); best[m] = 0 for all m.
2. For v in distinct values, ascending: for each multiple m of v, set best[m] = v if it is still 0.
3. Return Σ best[x].

Examples → 7, 9, 21. Checked against searching every reachable array on 1,500 small random arrays.

Using the overall minimum for everything: example 1 → 6 instead of 7.

Time: O(M log M)  
Space: O(M)

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
