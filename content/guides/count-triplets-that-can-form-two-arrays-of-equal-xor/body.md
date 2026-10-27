## Prefix XOR equality

1. `p[0] = 0`, `p[t+1] = p[t] ^ arr[t]`. A range i..k XORs to 0 exactly when `p[i] == p[k+1]`.
2. Each matching pair adds `k − i` = `(k+1) − i − 1`.
3. For each prefix value, keep its count and the sum of its indices; add `count · (t − 1) − sumIdx` as you scan.

`[2,3,1,6,7]` → 4. `[1,1,1,1,1]` → 10.

Do not loop over j; once the range XORs to 0, every j in (i, k] works. An O(n²) double loop over i, k also passes.

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
