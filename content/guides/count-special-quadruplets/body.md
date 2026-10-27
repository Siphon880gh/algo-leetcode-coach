## Meet in the middle

1. Counter `cnt` of `nums[d] − nums[c]` over pairs with `c > b`.
2. For `b` from `n − 3` down to 1: add `nums[d] − nums[b + 1]` for every `d > b + 1`; then for each `a < b`, add `cnt[nums[a] + nums[b]]` to the answer.

Examples → 1, 0, 4. Checked against the O(n⁴) loop on random arrays.

Adding pairs with `c = b + 1` as `b` moves left keeps exactly the pairs with `c > b`. With n ≤ 50 the plain four-loop check also passes, but this shows the O(n²) idea.

Time: O(n²)  
Space: O(n²) in the worst case (values ≤ 100 keep it tiny)

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
