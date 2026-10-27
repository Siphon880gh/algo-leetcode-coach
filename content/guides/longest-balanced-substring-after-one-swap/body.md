## Prefix positions

1. pos[b] = indices where balance b occurs, starting with pos[0] = [−1].
2. At i with balance b: length i − pos[b][0].
3. For b − 2: zeros inside = (len − 2) / 2; it works if that is below the total zeros. Try pos[b − 2][0], then pos[b − 2][1].
4. Same for b + 2 with ones.

The second earliest index is enough: the part between the two earliest has balance 0 and length ≥ 2, so it holds at least one zero and one one.

Examples → 4, 0. Checked against every swap and substring on 3,000 random strings.

Skipping the swap: example 1 → 2 instead of 4.

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
