Given a string and a list of queries, each a range [l, r], count the substrings of s[l..r] whose first and last characters are the same. Indexing and limits are in the official statement. For instance, s = abcaab: the whole string → 10, and the range [1, 3] (bca) → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Prefix counts

This assumes a single character counts as a substring and the string uses lowercase letters.

1. pre[i][x] = how many times letter x appears in s[0 … i − 1].
2. For [l, r]: `Σ c(c + 1) / 2` with `c = pre[r + 1][x] − pre[l][x]` over the 26 letters.

Constructed checks (run in code): the examples above; 500 random strings and queries match testing every substring.

Time: O(26 (n + q))  
Space: O(26n)

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
