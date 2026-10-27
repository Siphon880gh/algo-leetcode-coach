## Two maps

1. `add(x)`: `freq[cnt[x]]−−`, `cnt[x]++`, `freq[cnt[x]]++`.
2. `deleteOne(x)`: if `cnt[x] > 0`, the same in reverse.
3. `hasFrequency(f)`: return `freq[f] > 0`.

Examples → [null,null,null,true], [null,null,null,false], [null,false,null,true]. Checked against counting the list directly on 300 random sequences.

deleteOne on a missing number must do nothing; otherwise counts go negative and buckets drift.

Time: O(1) per call  
Space: O(distinct numbers)

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
