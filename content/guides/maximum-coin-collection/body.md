Two arrays give the coins gained (or, when negative, lost) at each mile in lane 1 and lane 2. Mario enters at any mile in lane 1, drives a contiguous stretch of at least one mile, and may switch lanes at most twice, including right at entry or just before leaving. Return the most coins he can end with. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Three running bests

This assumes, as restated, that the trip is one contiguous stretch of at least one mile and that a switch may happen right at entry.

1. For each mile with coins a (lane 1) and b (lane 2):
   - f0 = max(f0, 0) + a (start here or continue).
   - f1 = max(f0, f1, 0) + b (switch now, continue, or enter and switch at once).
   - f2 = max(f1, f2) + a.
   Use the previous mile’s values on the right-hand side.
2. Answer the largest f0, f1 or f2 seen.

Constructed checks (run in code): lane1 = [2, −3, 1, 4], lane2 = [−1, 5, 6, −2] → 17; lane1 = [−4, −1], lane2 = [−3, −6] → −1; lane1 = [−5, −5], lane2 = [3, 4] → 7. Checked against trying every stretch and lane pattern on 400 random cases.

Not allowing a switch at entry: lane1 = [−5, −5], lane2 = [3, 4] → −1 instead of 7.

Time: O(n)  
Space: O(1)

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
