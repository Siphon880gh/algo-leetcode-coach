## Check a prefix

1. ok(t): last[i] = last second ≤ t where changeIndices is i; if some index has none, false.
2. free = 0; for s = 1 … t: if s = last[changeIndices[s]], need free ≥ nums[i], then free −= nums[i]; else free += 1.
3. Binary-search the smallest t with ok(t), or −1.

Examples → 8, 6, −1. Checked against a search over every choice per second on 700 random small cases.

Marking at the last occurrence leaves the most time to decrement. Using the first occurrence gives example 1 → −1 instead of 8.

Time: O((n + m) log m)  
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
