## BFS

1. Factor every value with a smallest-prime-factor sieve; bucket[p] = indices divisible by p.
2. BFS: from i, go to i − 1 and i + 1; if nums[i] is prime p, go to every index in bucket[p], then clear it.
3. Answer the distance to n − 1.

Examples → 2, 2, 3. Checked against BFS with direct divisibility tests on 500 random arrays.

Teleporting through any shared prime factor (not only from prime values): example 3 → 1 instead of 3.

Time: O(n log M + M log log M)  
Space: O(n + M)

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
