## Nearest blockers

1. Left: block = max of last[b] over bits b not in nums[i], and the last equal value. L[i] = i − block.
2. Right: block = min of next[b] over bits b not in nums[i]. R[i] = block − i.
3. Return Σ L[i] · R[i].

Examples → 4, 6. Checked against every subarray on 2,000 random arrays.

Not stopping at equal values: constructed check (run in code) [2, 2] → 4 instead of 3.

Time: O(30 · n)  
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
