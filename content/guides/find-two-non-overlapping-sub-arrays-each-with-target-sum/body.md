## Window plus best-left

1. Slide `l`, `r`, shrinking while the sum exceeds target.
2. On sum == target: if `best[l−1]` is finite, `ans = min(ans, best[l−1] + (r − l + 1))`; update `cur = min(cur, r − l + 1)`.
3. `best[r] = cur`. Return `ans` or −1.

`[3,2,2,4,3]`, 3 → 2. `[7,3,4,7]`, 7 → 2. `[4,3,2,6,2,3,4]`, 6 → −1.

Do not pick the two globally shortest windows; they may overlap. Positivity is what makes the window valid.

Time: O(n)  
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
