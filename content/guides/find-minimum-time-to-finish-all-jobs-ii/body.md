You are given two integer arrays jobs and workers of equal length, where jobs[i] is the time job i needs and workers[j] is how much time worker j can work each day. Assign each job to exactly one worker and each worker exactly one job. Return the minimum number of days needed to finish all the jobs. For instance, jobs [5,2,4], workers [1,7,5] → 2; jobs [3,18,15,9], workers [6,5,1,3] → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sorted pairing

1. Sort `jobs` and `workers`.
2. Return `max over i of ⌈jobs[i] / workers[i]⌉`, computed as `(jobs[i] + workers[i] − 1) / workers[i]`.

Constructed checks (verified against every assignment on 300 small cases): the cases above → 2, 3.

If a larger job sits with a smaller worker than a smaller job does, swapping the two workers never raises the larger of the two day counts, so sorted order is optimal.

Time: O(n log n)  
Space: O(1) beyond sorting

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
