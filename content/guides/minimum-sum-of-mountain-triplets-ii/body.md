## Prefix and suffix minimum

1. `suf[j]` = min of nums[j + 1 …].
2. Scan j with the running min L of nums[0 … j − 1]; if `L < nums[j] > suf[j]`, best = min(best, L + nums[j] + suf[j]).
3. Return best, or −1.

Examples → 9, 13, −1. Checked against testing every triplet on 500 random arrays.

n reaches 10^5, so testing every triplet is about 1.7 · 10^14 checks.

Time: O(n)  
Space: O(n)

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
