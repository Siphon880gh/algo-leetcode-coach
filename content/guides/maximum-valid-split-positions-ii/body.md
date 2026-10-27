## Candidates

1. Candidates: indices where the prefix gcd changes or the suffix gcd changes (index 0 and n − 1 included).
2. Answer = max(score(nums), score after removing each candidate), where score counts i with pre[i] = suf[i + 1].

Examples → 2, 1, 0. Matched trying every removal on 4,000 random arrays.

Trying only the first and last element: constructed check (run in code) [12, 2, 12, 2, 3, 8] → 0 instead of 2.

Time: O(n log² V)  
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
