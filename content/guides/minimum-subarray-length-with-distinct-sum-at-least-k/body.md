## Window with counts

1. cnt = {}; s = 0; l = 0.
2. For each r: cnt[x]++; if it became 1, s += x.
3. While s ≥ k: best = min(best, r − l + 1); cnt[nums[l]]−−; if it became 0, s −= nums[l]; l++.
4. Return best, or −1.

Examples → 2, 2, 1. Checked against every subarray on 3,000 random arrays.

Adding repeated values to the sum: constructed check (run in code) nums = [3, 3], k = 6 → 2 instead of −1.

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
