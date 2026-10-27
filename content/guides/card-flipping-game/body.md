## Only same-card doubles are blocked

1. `bad = {fronts[i] for i if fronts[i] == backs[i]}`.
2. The answer is the minimum number in `fronts + backs` that is not in `bad`, or 0 if none.

Why any other number `x` works: flip every card so that `x` is not on its front. That is possible for each card, because no card has `x` on both sides. Then pick a card that shows `x` on its back.

Do not simulate flips; the set argument is enough. Do not consider only the backs; a front value can be flipped to the back too.

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
