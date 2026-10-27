## Sweep x

1. Sort nums; f = bitset with bit 0 set; i = 0.
2. For x = 1 … n: while nums[i] < x, f |= f << nums[i] (cut to k bits) and i += 1. c = n − i.
3. answer[x − 1] = some j in 0 … c with k − j · x ≥ 0 and bit k − j · x set in f.

Examples → [false, false, true, true], [true, true, true, true, true]. Checked against trying every subset on 1,500 random cases.

Leaving out the capped elements: example 1 → [false, false, false, true].

Time: O(n · k / w + k log n), w = word size  
Space: O(k / w)

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
