## Bit counts

1. cnt[b] = window elements with bit b set; the window’s OR has bit b when cnt[b] > 0.
2. For each r: add nums[r]. While l ≤ r and OR ≥ k: best = min(best, r − l + 1); remove nums[l]; l += 1.
3. Return best, or −1.

Examples → 1, 3, 1. Checked against brute force on 3,000 random arrays.

XOR does not undo OR: removing with XOR gives [1, 1, 2], k = 3 → 3 instead of 2.

Time: O(30 n)  
Space: O(30)

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
