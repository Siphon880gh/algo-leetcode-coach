## Direct approach

1. All `n(n+1)/2` subarray sums via prefix sums.
2. Sort; return `Σ s[left−1 .. right−1] mod 1e9+7`.

`[1,2,3,4]`: left 1, right 5 → 13; left 3, right 4 → 6; left 1, right 10 → 50.

Faster: f(k) = sum of the k smallest sums, by binary searching the k-th value and counting with a sliding window; answer = f(right) − f(left − 1). A min-heap of (sum, i, j) also works in O(right log n).

Time: O(n² log n)  
Space: O(n²)

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
