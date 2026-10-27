## Digit counts

1. `c[1..9] = 0`, `ans = 0`.
2. For each v: `ans += Σ c[d]` over d with `gcd(d, v mod 10) = 1`; then `c[first digit of v] += 1`.
3. Return ans.

Examples → 5, 2. Checked against testing every pair on 300 random arrays.

Update c after counting, so a number never pairs with itself. With n ≤ 100 the pair loop also works; the counts make it O(9n).

Time: O(9n)  
Space: O(1)

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
