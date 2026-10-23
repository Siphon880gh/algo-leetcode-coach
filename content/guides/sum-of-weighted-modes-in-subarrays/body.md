Given an integer array nums and an integer k, look at every subarray of length k. Its mode is the value with the highest frequency, and this assumes ties go to the smaller value. Add mode × frequency for every such subarray and return the total. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Slide

1. For each new x: cnt[x]++, push (−cnt[x], x).
2. When the window passes k: drop the leftmost y, cnt[y]−−, push (−cnt[y], y) if cnt[y] > 0.
3. Pop entries whose count no longer matches; the top (−f, v) gives the mode v with frequency f. Add v · f.

Constructed checks (run in code): [1, 2], k = 2 → 1; [2, 2, 1], k = 2 → 5; [3, 1, 3, 1], k = 3 → 8. Checked against counting every window on 2,000 random arrays.

Breaking ties toward the larger value: [1, 2], k = 2 → 2 instead of 1.

Time: O(n log n)  
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
