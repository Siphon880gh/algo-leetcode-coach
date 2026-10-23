Given a lowercase string s and an integer k, keep every character whose total number of occurrences in s is less than k, in the original order, and return the result (empty if none qualify). Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two passes

1. cnt = letter counts of s.
2. Return the characters c of s with cnt[c] < k, in order.

Constructed checks (run in code): "aab", k = 2 → "b"; "abcabc", k = 2 → ""; "zzz", k = 4 → "zzz".

Keeping counts ≤ k: "aab", k = 2 → "aab" instead of "b".

Time: O(n)  
Space: O(1) (26 letters)

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
