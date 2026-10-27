## Memoized search

1. go(i, j, cur): if j = m, return 0 when i = n, else ∞. If i = n, ∞.
2. c = cur & nums[i]. If c < andValues[j], ∞ (it cannot rise again).
3. Return min(go(i + 1, j, c), nums[i] + go(i + 1, j + 1, all ones) if c = andValues[j]).

Examples → 12, 17, −1. Checked against trying every split on 500 random small cases.

The part’s value is its last element, so it is added when the part closes, not when it opens.

Time: O(n · m · log max) states  
Space: same

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
