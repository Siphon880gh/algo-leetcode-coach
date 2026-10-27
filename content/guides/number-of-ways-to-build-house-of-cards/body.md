Given n playing cards, count the distinct houses of cards that use all n cards. A row of k triangles uses 3k − 1 cards (two leaning cards per triangle and a horizontal card between neighbours), each triangle above the bottom row must sit on a horizontal card of the row below, and two houses differ if some row has a different number of cards. For instance, 16 → 2; 2 → 1; 4 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Distinct parts of the form 3k − 1

1. `ways[0] = 1`.
2. For `k = 1, 2, …` while `3k − 1 ≤ n`: for `s = n … 3k − 1`: `ways[s] += ways[s − (3k − 1)]`.
3. Return `ways[n]`.

Constructed checks (verified against every subset of row sizes for n up to 39): 16 → 2 (rows of 2 + 14 or 5 + 11 cards), 2 → 1, 4 → 0.

Sitting on horizontal cards means a row of k triangles supports at most k − 1, so sizes strictly decrease upward and any set of distinct sizes stacks.

Time: O(n²)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
