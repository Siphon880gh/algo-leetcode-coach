## Bitset of sums

1. Sort the distinct values. f = {0}.
2. For each v: f ∪= {x + v : x ∈ f, x < v}.
3. Return max(f). Every sum stays below 2 · max(rewardValues).

Examples → 4, 11. Checked against trying every order on 300 random arrays.

Greedily taking each value that fits gives example 2 → 7 instead of 11.

Time: O(n · M), M = max value  
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
