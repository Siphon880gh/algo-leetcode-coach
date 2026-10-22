Given a length range and two group sizes, count binary strings whose length lies in the range and in which every maximal block of 1s has a length that is a multiple of the first size and every maximal block of 0s a multiple of the second. Return the count modulo a large prime, as the official statement gives. For instance, lengths 2 to 3 with sizes 1 for ones and 2 for zeros → 5 (11, 00, 111, 100, 001). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Chunk DP

1. `dp[0] = 1`.
2. For `i = 1 … maxLength`: `dp[i] = dp[i − oneGroup] + dp[i − zeroGroup]` (terms with negative index are 0), reduced by the modulus.
3. Return `Σ dp[minLength … maxLength]` under the modulus.

Constructed checks (verified against listing every binary string on 150 random small cases): the case above → 5; lengths 1 to 2 with both sizes 2 → 2.

A 1-block of length a multiple of oneGroup is a run of whole chunks, and adjacent chunks of the same letter merge into one block whose length is still a multiple, so every good string has exactly one chunking. The count still holds when both sizes are equal, since a chunk’s letter tells the two apart.

Time: O(maxLength)  
Space: O(maxLength)

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
