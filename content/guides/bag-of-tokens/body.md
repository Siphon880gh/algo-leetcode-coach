## Two pointers on sorted tokens

Sort `tokens`. `i = 0`, `j = n − 1`, `score = best = 0`.

While `i ≤ j`:

- If `power ≥ tokens[i]`: `power −= tokens[i]`, `i += 1`, `score += 1`, `best = max(best, score)`.
- Else if `score > 0` and `i < j`: `power += tokens[j]`, `j −= 1`, `score −= 1`.
- Else stop.

Return `best`.

Every point costs the same, so buy points with the cheapest tokens and trade a point only for the most power.

`i < j` avoids trading a point for the very token you would then need to buy back.

Do not return the final score; trading at the end can lower it, so keep the maximum. Do not play face down when you could play face up.

Time: O(n log n)  
Space: O(1) besides the sort

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
