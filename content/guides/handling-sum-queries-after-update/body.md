## Track only the count

1. Build a segment tree over `nums1` storing the number of 1s per node; `total = Σ nums2`.
2. Type 1: flip `[l, r]`; a fully covered node becomes `length − count` and toggles its lazy flag.
3. Type 2: `total += p · root count`.
4. Type 3: record `total`.

Examples → [3], [5]. Checked against direct simulation on 300 random query lists.

nums2 itself never needs updating, only its sum. The total can reach about 10^16, so use 64-bit.

Time: O(n + q log n)  
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
